# Enfold Tweaks

We are using the [Enfold Theme](http://www.kriesi.at/themes/enfold-overview/) as a parent theme for several sites and I needed some tweaks.

### Supported Version : `Enfold: v.3.7.1`

#### Note
This is very much beta, it may have side-effects on your site. If so, please [post an issue](https://github.com/thatryan/enfold-tweaks/issues) and I will add it to my list!

## What Does It Do

* Removes many of the enqueued styles from the Enfold theme and replaces with a concatenated and minified version
* Tweaks the mobile styles a tad, font sizes and padding by default are huge
* Enables the CSS class field for all elements in layout builder
* Removes debug info from the `<head>`
* Bonus: Also does some other head cleanup
* Deactivates layer slider, not used by us
* Concatenates and minifies scripts

## Installation

You can grab this whole repo and play with it if you wish, or if you just want the plugin grab it from the `/dist` folder.

## Usage

Once installed and activated it will do its thing. View page source before and after to see the difference in the `<head>` section.

## TODO

* Move dynamic CSS lower in priority

## Bugs

Something broken? If you find a bug or have a suggestion/request, [let me know](https://github.com/thatryan/enfold-tweaks/issues)!

#### Dev Notes

Rewrite for better dependencies, https://medium.com/@dave_lunny/task-dependencies-in-gulp-b885c1ab48f0#.w866oi8d9

During concatenation I run into issues with `avia.js`

* ~line 2093 missing semicolon at end of jQuery exp regex function
