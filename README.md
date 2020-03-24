# CoLogger

Very simple PHP Logger with colors

## Use

By default the logger will output to a file in the directory that the file resides in with the name 'cologger.log'.

This (and console output) can be changed.

The class uses Linux console text modifiers ( \e[...m ), this has not been tested on Windows.

Notice: to write to a file, the process trying to do it needs to have file creation and file writing permissions.

### Functions

```php
$logger = new Logger;

$logger->error("error");
$logger->warning("warning");
$logger->notice("notice");
$logger->log("normal");
```
Errors will be red, Warnings will be orange, Notices will be green and Logs will be white. Each log will be placed in a new line with data about the date and time of logging.

### Parameters

The first parameter is a string representing the location of the file. The second argument is a boolean, defaulted to false, to write to console instead.
```php
$logger = new Logger("mytarget.log");

$console = new Logger("doesn't matter", true);
```

## Future Features

- Formatting the log metadata.
- Changing the color scheme.
- Adding color to the message itself (without doing it by hand)
- Quick and better way to change logging targets
