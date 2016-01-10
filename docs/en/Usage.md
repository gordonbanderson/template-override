#Usage
##Editing
The module adds an extra tab called 'Template' (or i18n equivalent).  In that
tab is a field called 'Alternative template name'.  Simply type the name of
template you wish to use instead into this field.  If it is blank or cannot
be found the usual template shall be used.
##Location of Template
If the template is located in /path/to/templates/Layout it will override the
normal rendering of $Layout in one's template.  However if it is placed one
directory above, it will override the template for the entire page, including
header, menus and footer.

![Overriding Default Template]
(https://raw.githubusercontent.com/gordonbanderson/template-override/screenshots/screenshots/template001.png
"Overriding Default Template")
