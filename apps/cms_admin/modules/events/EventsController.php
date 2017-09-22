<?php
/*
Post value 'today' actually refers to on day of Event
*/
class EventsController extends SiteAdminController
{
	public function loadDefault($parameters)
	{
		$this->loadModule('site_admin', 'events', 'edit', true, true, $parameters);
		return false;
	}

	public function loadEdit($parameters)
	{
		$event = false;
		$post = false;

		//If the user hit Save/Save&Publish
		if (isset($_POST['posted']))
		{
			$errors = $this->validatePost();

			if(count($errors) > 0)
			{
				$parameters = array_merge($parameters, $errors);
				$event = Event::initFromPost($_POST);
			}
			else
			{
				$eventSaved = false;

				//Set event details and save
				$event = $this->setEventDetails($parameters);
				$eventSaved = $event->save();

				if (!$eventSaved)
				{
					$action = 'saved';
					$event = Event::initFromPost($_POST);
				}
				else
				{
					if(isset($_POST['post_schedule']) && trim($_POST['post_schedule']) !== "")
					{
						$postSaved = $this->saveSocialPost($event);
					}
					if(isset($_POST['id']) && trim($_POST['id']) !== "")
						$action = 'updated';
					else
						$action = 'created';
				}

				//Set parameters for messages
				$parameters = array(
					'action' => $action,
					'event' => $event->getId(),
					'saved' => $eventSaved
				);

				//Was there a post? Did it save? Add it for messages
				if(isset($postSaved))
					$parameters['postSaved'] = $postSaved;

				unset($_POST);
				$this->loadModule('site_admin', 'events', 'edit', true, true, $parameters);
				return false;
			}
		}

		//If viewing an event which wasn't just created
		if (!$event && isset($parameters['event']))
		{
			$event = new Event();
			$event->init($parameters['event']);
			$this->post = SocialMediaCollection::getAssocSocialMedia("event", $parameters['event']);
		}

		//Set messaging
		$this->setMessages($parameters);

		//Social Media checks
		$socialMediaChecks = SocialMedia::checkService('all');
		$this->anyAuthed = $socialMediaChecks->oneOrMore;
		$this->allAuthed = $socialMediaChecks->all;
		$this->authServices = $socialMediaChecks->services;

		$this->events = EventCollection::getAll();
		$this->event = $event;
		$this->post = $post;

		return true;
	}

	public function saveSocialPost($event)
	{
		$smObj = SocialMediaCollection::getAssocSocialMedia("event", $event->getId());
		if(!$smObj)
			$smObj = new SocialMedia();
		$smObj->setService("post");
		$smObj->setType("post");
		$content = json_decode($_POST['post_schedule'], true);
		//Convert start_date to Unix timestamp
		$content['start_date'] = strtotime($content['start_date']);
		$smObj->setContent(json_encode($content));
		$smObj->setAssociatedId("event:".$event->getId());
		return count(json_decode($_POST['post_schedule'], true)) ? $smObj->save() : -1;
	}

	public function setEventDetails($parameters)
	{
		$event = new Event();
		if(isset($_POST['id']) && trim($_POST['id']) !== "")
		{
			$oldEvent = $event->init($_POST['id']);
			if(isset($oldEvent))
				$event = $event->init($_POST['id']);
			else
				$event->setCreatedAt(date('Y-m-d G:i'));
		}
		else
		{
			$event->setCreatedAt(date('Y-m-d G:i'));
		}

		$event->setTitle($_POST['title']);
		$event->setLocation($_POST['location']);
		$event->setDescription($_POST['event_description']);
		$event->setStartDatetime(date('Y-m-d G:i', strtotime($_POST['start_date'] . $_POST['start_time'])));
		if (isset($_POST['end_date']) && $_POST['end_date'] != "" && isset($_POST['end_time']) && $_POST['end_time'] != "")
			$event->setEndDatetime(date('Y-m-d G:i', strtotime($_POST['end_date'] . $_POST['end_time'])));
		$event->setRepeating($_POST['repeating']);
		$event->setIsPublished($_POST['publish']);

		$event->setUpdatedAt(date('Y-m-d G:i'));

		return $event;
	}

	public function loadSaveDraft()
	{
		$event = new Event();

		$event = $this->setEventDetails($event);
		$event->setIsPublished(0); //When redirecting to auth SocialMedia services, always save as draft.
		$title = $event->getTitle();
		if(!isset($title) || trim($title) == "")
			$event->setTitle("Draft: " . date("d/m/Y G:i"));
		$eventSaved = $event->save();

		if(isset($_POST['post_schedule']) && trim($_POST['post_schedule']) !== "")
			$postSaved = $this->saveSocialPost($event);
	}

	public function loadDelete($parameters)
	{
		$event_id = $parameters['event'];

		$event = new Event();
		$event->init($event_id);

		$this->loadModule('site_admin', 'events', '', true, true, array('deleted' => $event->delete()));
	}

	public function validatePost()
	{
		$errors = array();
		//title
		if(!isset($_POST['title']) || trim($_POST['title']) == "")
			$errors['no_title'] = 1;

		//location
		if(!isset($_POST['location']) || trim($_POST['location']) == "")
			$errors['no_location'] = 1;

		//start date
		if(!isset($_POST['start_date']) || trim($_POST['start_date']) == "")
			$errors['no_start_date'] = 1;
		else if(!strtotime($_POST['start_date']))
		{
			$errors['bad_date'] = 1;
			$_POST['start_date'] = "";
		}

		//start time
		if(!isset($_POST['start_time']) || trim($_POST['start_time']) == "")
			$errors['no_start_time'] = 1;
		else if(!strtotime($_POST['start_time']))
		{
			$errors['bad_time'] = 1;
			$_POST['start_time'] = "";
		}

		$start = strtotime($_POST['start_date'] . $_POST['start_time']);

		//end date & time
		if((isset($_POST['end_date']) && trim($_POST['end_date']) !== "") || (isset($_POST['end_time']) && trim($_POST['end_time']) !== ""))
		{
			//End formatting
			if(!strtotime($_POST['end_date']))
			{
				$errors['bad_date'] = 1;
				$_POST['end_date'] = "";
			}

			if(!strtotime($_POST['end_time']))
			{
				$errors['bad_time'] = 1;
				$_POST['end_time'] = "";
			}

			//End before start?
			$end = strtotime($_POST['end_date'] . $_POST['end_time']);
			if ($start >= $end)
				$errors['end_before_start'] = 1;
		}

		return $errors;
	}

	public function setMessages($parameters)
	{
		foreach($parameters as $parameter => $paramValue)
		{
			switch($parameter)
			{
				/*
				Exception parameters
				*/
				case 'event':
				case 'action':
					//Do nothing
					break;

				/*
				Validation Messages
				*/
				case 'no_title':
					$this->bad[] = "Events require a title.";
					break;

				case 'no_location':
					$this->bad[] = "Events require a location.";
					break;

				case 'no_start_date':
					$this->bad[] = "Events require a start date";
					break;

				case 'no_start_time':
					$this->bad[] = "Events require a start time";
					break;

				case 'end_before_start':
					$this->bad[] = "The event's end time must be later than its start time.";
					break;

				case 'bad_date':
					$this->bad[] = "Please format your date as mm/dd/yyyy.";
					break;

				case 'bad_time':
					$this->bad[] = "Please format your time as hh:mm.";
					break;

				/*
				Event Messages
				*/

				case 'postSaved':
					if($paramValue == -1)
					{
						$this->good[] = "Post cleared.";
					}
					else
					{
						if($paramValue)
							$this->good[] = "Post saved.";
						else
							$this->bad[] = "Post not saved.";	
					}
					break;

				// case 'created':
				// 	if($paramValue)
				// 		$this->good[] = "Event created.";
				// 	else
				// 		$this->bad[] = "Event not created.";
				// 	break;

				// case 'updated':
				// 	if($paramValue)
				// 		$this->good[] = "Event updated.";
				// 	else
				// 		$this->bad[] = "Event not updated.";
				// 	break;

				// case 'deleted':
				// 	if($paramValue)
				// 		$this->good[] = "Event deleted.";
				// 	else
				// 		$this->bad[] = "Event not deleted.";
				// 	break;

				case 'saved':
					if($paramValue)
						$this->good[] = "Event ".$parameters['action'].".";
					else
						$this->bad[] = "Event not ".$parameters['action'].".";
					break;

				default:
					if($paramValue)
						$this->good[] = "Event " . $parameter . ".";
					else
						$this->bad[] = "Event not " . $parameter . ".";
					break;

				// default:
				// 	Debug::e(null, 1, "Parameter '" . $parameter . "' with value '" . $paramValue . "' is unsupported.");
				// 	break;
			}
		}
	}
}