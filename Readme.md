# silverstripe-gridfield-is-published

Extension for versioned dataobjects to visually show if they are published in the gridfield.

Just apply the extension to the dataobjects that you would like to visually show if they are published or not in the GridField. 

```
<?php
class MyDataObject extends DataObject
{

	...

	private static $extensions = array(
		'GridFieldIsPublishedExtension'
	);

	...
}
```
