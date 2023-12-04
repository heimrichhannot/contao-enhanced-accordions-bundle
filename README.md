# Enhanced accordions bundle

This bundle enhances the work with contao accordions for template designers and developers.

## Features

- add additional variables to accordions templates to create templates groups
- optional bootstrap 5 enhancements for the default templates
- bundles bootstrap 5 accordion templates

## Usage

### Install

Install with composer or contao manager and update your database.

```bash
composer require heimrichhannot/contao-enhanced-accordions-bundle
```

### Use bootstrap 5 integration

![screenshot.png](docs%2Fimg%2Fscreenshot.png)

In your theme settings, select bootstrap 5 frontend framework and activate the checkbox "Adjust default template". 
This adds some css classes and markup to make the default work with boostrap 5 javascript component.
This is no complete replacement, as the default templates can not completely adjust without overriding for bootstrap 5.

The bundle also provides bootstrap 5 accordion templates, that can be selected as custom template.

### Additional template variables

The bundle adds additional variables to the accordion templates, that can be used to enhance your templates. 
A accordion group is defined by consecutively accordion start and stop elements OR single accordion elements.


| Variable                   | Description                                              |
|----------------------------|----------------------------------------------------------|
| `accordion_parentId` (int) | The id of the first element of the accordion group.      |
| `accordion_first` (bool)   | `true` if the element is the first element of the group. |
| `accordion_last` (bool)    | `true` if the element is the last element of the group.  |
