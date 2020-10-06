# TYPO3 extension site_config_modifier

This extension provides a new value modifier `:= getSiteConfig()` for
TypoScript syntax that reads configuration values from the site configuration
into TypoScript values.

## Installation

### Composer

```bash
composer require undkonsorten/typo3-site-config-modifier
```

### Git
```bash
# cd to typo3conf/ext
git clone https://github.com/undkonsorten/typo3-site-config-modifier.git site_config_modifier
```

## Usage

Can be used in constants, setup and TSConfig
(suggested usage in constants):

```typo3_typoscript
myConstant = defaultValue

# myConstant will be overridden if env var is defined at all.
# Empty env vars will override, too!
myConstant := getSiteConfig(mykey)
```
