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

### Generate TPP Wholesale fully unencrypted Archive

`$ gulp buildEncrypted --module ibs`

### Generate whmcs*.zip to whmcs.tar.gz and export mysql dump

`$ gulp databaseDump`