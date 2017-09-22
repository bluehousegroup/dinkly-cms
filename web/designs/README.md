Theming
=======

Theme directory format:
-----------------------

+ css
+ font
+ html
 + includes (containing header and footer)
 + (all your .php template files)
+ img
+ js
 + lib (containing bootstrap js directory, jquery, and html5shiv)
 + thirdparty (all your js widgets)
 + (all your custom .js files)
+ config.yml
+ preview.png (240x180)

Moving from HTML to CMS Controlled Templates:
---------------------------------------------

### Quick Summary ###
We will be defining all the content blocks on our templates in a config file, which which is then rendered in the CMS as fields.  Next we just have to remove placeholder content in the HTML and swap it out for php hooks that bring in content from those rendered CMS fields.

### Step 1 - Adjust pathing ###
First we should prep our html's relative links.  All of these links should begin with '/designs/*your_theme_name*/'.  For example:

    <link href="css/styles.css" />

would change to (note leading slash):

    <link href="/designs/theme_name/css/styles.css" />

### Step 2 - Split into header/footer ###
Create blank header.php and footer.php files and put them in html/includes.  Fourtopper will include this automatically on every page.  Therefore, you should make sure the content here is indeed global (usually doctype to end of nav for header, and from the footer to `</html>` in your footer).  Remove your global header and footer from your html and paste them into your new includes.

### Step 3 - Paste important includes ###
1. Include the following title and meta tags - First items in the head


        <title><?php echo ($settings['meta_title']) ? $settings['meta_title'] : $settings['page_title']; ?></title>
		<meta name="keywords" content="<?php echo $settings['meta_keywords']; ?>">
		<meta name="description" content="<?php echo $settings['meta_description']; ?>">


2. Draftmode css include - Before your stylesheet include

	    <?php if($is_draft): ?>
		<link rel="stylesheet" type="text/css" href="/css/draft.css">
		<?php endif; ?>

3. User css include - After your stylesheet include
		
		<style><?php echo $settings['site_custom_css']; ?></style>

4. Draftmode html snippet - directly after opening body tag

	    <?php if($is_draft): ?>
	    <div id="draft-message" class="draft-label">Viewing Draft Site</div>
	    <?php endif; ?>

### Step 5 - Build navigation ###

1. To create a logo linked to the homepage, as seen frequently in headers, use the following:

        <a href="<?php echo $base_path; ?>"><img src="<?php echo $logo_path; ?>" /></a>
    Of course you will need to add in whatever classes/custom markup you used in the html.  The php hooks are what you should most concerned about here.
2.  Main navigation
    
    Navigation is sent to our template with the variable $nav_items, so we loop over it with 'foreach', defining each singular nav item as $nav.  You can access the properties of that singlular item as seen below with '->'.

        <ul class="nav">
            <?php foreach($nav_items as $nav): ?>
            <li><a href="<?php echo $base_path; ?>/<?php echo $nav->getSlug(); ?>"><?php echo $nav->getLabel(); ?></a></li>
			<?php endforeach; ?>
        </ul>

3. Many common global variables are already available to you, see the following:

        $settings['address'];
        $settings['city'];
        $settings['state'];
        $settings['zip_code'];
        $settings['page_title'];
        
    This list may not be entirely inclusive, but follows a simple pattern.  Just look in the settings tab of fourtopper site_admin and the fields available.  If there is a field you want to build a hook for, just look at its label and place it lowercased into $settings['your_label_here'].  Note that words are separated with underscores.

Defining Content Blocks in config.yml
-------------------------------------

###### Important notes about YAML ######
YAML files are used to create a hierarchical data structure using indents.  You have to make sure your editor is indenting with 4 spaces rather than single tabs.  If this is your first time creating a config file, look at another theme's file as a reference! <b>Your yaml changes won't be reflected in the cms until you flag dinkly to reparse its files with the URL flag: ?nocache=1</b>

### Step 1 - Copy an existing config.yml into the root of theme ###
Table 34 is a good starting point.

### Step 2 - Fill out the area above 'Page Templates' ###

1. name: Name of your theme in single quotes
2. desc: Short description of your theme wrapped in single quotes
3. code: name of project directory
4. preview_image: keep as 'preview.png' - screenshot of theme, lives at theme root (240x180)
5. layout: either 'single' or 'multiple' - single refers to a onepage design like deweys, otherwise multiple, if you have a traditional theme with multiple pages
6. is_public: 'true' or 'false' - determines if it shows up as an available design for a client to choose from

### Step 3 - Define all your pages ###

After the colon in 'page_templates:' hit enter and one tab (remember that your editor should be converting these to 4 spaces).
```yaml
page_templates:
    - page_name:
    - page_name:
```
Each page name should match the name you have given each template in your html/ directory, so:
"- home:" would look for html/home.php

### Step 4 - Create content blocks ###
##### Intro to content block types ######
There are several content block types available to you, and they create different fields in the cms.  You also grab these blocks differently depending on the type in your template.
#### text ####
Creates a text editor in the cms.

<em>Properties:</em>

- code: unique name to identify the field for use in template
- desc: plain english description of field wrapped in single quotes
- hint: plain english remark if further explaination is needed, wrapped in single quotes - prints your hint into the field label wrapped in ().

<em>example:</em>

```yaml
- text: {code: intro_text, desc: 'Left column intro text', hint: 'Keep below 20 words'} 
```
    
```php
//get html
$intro_text->getHtml();
```

#### image ####
Creates an image upload field in the cms.

<em>Mandatory Properties:</em>
- code: unique name to identify the field for use in template
- desc: plain english description of field wrapped in single quotes
- hint: plain english remark if further explaination is needed, wrapped in single quotes - prints your hint into the field label wrapped in ().
- has_caption: true or false, true creates a text field for client to enter caption text

<em>Non-Mandatory Properties</em>
- crop_height: defines a height to crop at, takes a integer (pixel value)
- crop_width: defines a width to crop at, takes a integer (pixel value)

<em>example:</em>
```yaml
- image:{code: banner_image, desc: 'Banner Image', hint: 'Cropped at 980x400', crop_height: 400, crop_width: 980, has_caption: true}
```
```php
//get src
$banner_image->getOriginalSource();
//get caption text
$banner_image->getCaption();
```
#### slideshow ####
Creates a slideshow interface in cms.

<em>Properties:</em>
- code: unique name to identify the field for use in template
- desc: plain english description of field wrapped in single quotes
- hint: plain english remark if further explaination is needed, wrapped in single quotes - prints your hint into the field label wrapped in ().

<em>example:</em>
```yaml
- slideshow:{code: slideshow, desc: 'Slideshow', hint: ''}
```

```php
if(count($slideshow->getSlides()) > 0):
	foreach($slideshow->getSlides() as $slide):
        //get slide source
        echo $slide->getOriginalSource();
        //get slide caption
        echo $slide->getCaption();
	endforeach;
endif;
```

#### menu ####
Defines which pages to make menu available on.

<em>Properties</em>
- code: unique name to identify the field for use in template
- desc: plain english description of field wrapped in single quotes
- hint: plain english remark if further explaination is needed, wrapped in single quotes - prints your hint into the field label wrapped in ().

<em>example:</em>
```yaml
- menu: { code: menu, desc: 'Menu', hint: '' }
```
```html
<ul class="nav menu-nav">
    <?php foreach($menu->getMenus() as $pos => $m): ?><li><a href="#menu-<?php echo $m->getSlug(); ?>"><?php echo $m->getTitle(); ?></a></li><?php endforeach;?>
</ul>
<?php endif; ?>

<div class="main-content">
	<?php if(count($menu->getMenus()) > 0): ?>
	<?php foreach($menu->getMenus() as $pos => $m): ?>
	<section class="menu-section" id="menu-<?php echo $m->getSlug(); ?>">

		<h2><?php echo $m->getTitle(); ?></h2>
		<div class="menu-category-wrap">

			<?php if(count($m->getGroups()) > 0): ?>
			<?php foreach($m->getGroups() as $group): ?>
			<div class="menu-category">

				<h3><?php echo $group->getTitle(); ?></h3>
				<?php if(count($group->getItems()) > 0): ?>
				<ul class="item-list menu-list">
					<?php foreach($group->getItems() as $item): ?>
					<li>
						<div class="item">
							<h4><?php echo $item->getTitle(); ?></h4>
							<p><?php echo $item->getDescription(); ?> <?php if($item->getPrices() != array()): ?><?php foreach($item->getPrices() as $price): ?><span class="size"><?php echo $price->getTitle(); ?></span> <span class="price"><?php echo $price->getPrice(); ?></span><?php endforeach; ?><?php endif; ?></p>
						</div>
					</li>
				<?php endforeach;?>
				</ul>
				<?php endif; ?>

			</div>
			<?php endforeach;?>
			<?php endif; ?>

		</div>

	</section>
	<?php endforeach;?>
	<?php endif; ?>
</div>
```
#### event ####
Defines which pages to make events available on.

<em>Properties</em>
- code: unique name to identify the field for use in template
- desc: plain english description of field wrapped in single quotes
- hint: plain english remark if further explaination is needed, wrapped in single quotes - prints your hint into the field label wrapped in ().

<em>example:</em>

```yaml
- event: { code: event, desc: 'Event', hint: '' }
```
```html
<div class="events">
    <?php foreach ($events as $event): ?>
		<div class="event">
			<h4 class="date"><?php echo $event->getStartDatetime("F j, Y g:ia"); ?><?php echo ($event->getEndDatetime()) ? " - " . $event->getEnddatetime("F j, Y g:ia") : "" ?></h4>
			<?php if ($isDetail): ?>
				<h3><?php echo $event->getTitle() ?></h3>
				<p><?php echo $event->getDescription() ?></p>
			<?php else: ?>
				<h3><a href="<?php echo $event->getUrl(); ?>"><?php echo $event->getTitle() ?></a></h3>
				<p><?php echo $event->truncate($event->getDescription(), 5) ?></p>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>
```

### Final YAML Example ###
```yaml
title: 'My Theme'
desc: 'A theme perfect for blah blah'
code: 'mytheme'
preview_image: 'preview.png'
layout: multiple
is_public: true
page_templates:
    - home:
        - slideshow: { code: slideshow, desc: 'Slideshow' }
        - image: { code: image1, desc: 'Left column image', has_caption: true, hint: 'Cropped to 980x400', crop_height: 400, crop_width: 980 }
        - text: { code: left_text, desc: 'Left column content', hint: ''}
    - menu:
        - menu: { code: menu, desc: 'Menu', hint: '' }
    - events:
        - event: { code: events, desc: 'Events', hint: '' }
```
