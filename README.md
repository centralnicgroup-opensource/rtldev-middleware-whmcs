# Technical Documentation

... TO BE EXTENDED ...

## Gulp Tasks

### Release TPP Wholesale Archive

`$ gulp preRelease --module tpp`

### Release IBS Archive

`$ gulp preRelease --module ibs`

### Generate Encrypted Archive

`$ gulp buildEncrypted`

### Generate Partially Encrypted Archive

`$ gulp buildEncrypted --module internal`

### Generate TPP Wholesale fully unencrypted Archive

`$ gulp buildEncrypted --module tpp`

### Generate IBS Wholesale fully unencrypted Archive

`$ gulp buildEncrypted --module ibs`

### Generate whmcs\*.zip to whmcs.tar.gz and an export of database dump

`$ gulp dbDumpWhmcs`

### Export a new database dump only

`$ gulp dbDump`

### Copy Changed CNIC Template Files to WHMCS Directory

Automatically copy any updates made to the CNIC template files to the corresponding WHMCS directory.

`$ gulp themeWatcher`

### Debugging using xDebug

First make sure to start the debugging via Run > Start Debugging (F5), then you can simply call xdebug_break() in your code where you want the execution to pause, and the debugger will break at that point.