# CoLogger

Very simple PHP Logger with colors

## Use

By default the logger will output to a file in the directory that the file resides in with the name 'logger.log'.

This can be changed with the `Logger::$logf` static variable.

Alternatively you can choose to output everything to the console, by changing the `Logger::$console` to true.

The class uses Linux console text modifiers ( \e[...m ), this has not been tested on Windows.

Notice: to write to a file, the process trying to do it needs to have file creation and file writing permissions.

### Functions

```php
Logger::error("error");
Logger::warning("warning");
Logger::notice("notice");
Logger::log("normal");
```
Errors will be red, Warnings will be orange, Notices will be green and Logs will be white. Each log will be placed in a new line with data about the date and time of logging.

## Future Features

- Formatting the log metadata.
- Changing the color scheme.
- Adding color to the message itself (without doing it by hand)
- Quick and better way to change logging targets
