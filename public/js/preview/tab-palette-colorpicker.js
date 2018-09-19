(function ($) {
  'use strict';

  $(document).ready(function() {
    var colorPickerTabPalette = new ColorPicker.TabPalette('#dc-ex1', {

    });

    var colorPickerTabPaletteCustomAnchor = new ColorPicker.TabPalette('#dc-ex2', {
      color: 'green'
    });

    var colorpickerInsideInputAnchor = $('#dc-ex3-anchor').find('[data-color]');
    var colorPickerTabPaletteInsideInput = new ColorPicker.TabPalette('#dc-ex3', {
      color: 'blue'
    });
    colorpickerInsideInputAnchor.css('background', colorPickerTabPaletteInsideInput.getColor());
    colorPickerTabPaletteInsideInput.on('change', function(color) {
      colorpickerInsideInputAnchor.css('background', color);
    });
    colorpickerInsideInputAnchor.on('click', function () {
      $('#dc-ex3').trigger('focus');

      return false;
    });

    var colorpickerInsideInputAnchorLeft = $('#dc-ex4-anchor').find('[data-color]');
    var colorPickerTabPaletteInsideInputLeft = new ColorPicker.TabPalette('#dc-ex4', {
      color: 'purple'
    });
    colorpickerInsideInputAnchorLeft.css('background', colorPickerTabPaletteInsideInputLeft.getColor());
    colorPickerTabPaletteInsideInputLeft.on('change', function(color) {
      colorpickerInsideInputAnchorLeft.css('background', color);
    });

    var colorPickerTabPaletteInline = new ColorPicker.TabPalette('#dc-ex5', {
      inline: true
    });

    var colorPickerTabPaletteCustomAnchorInline = new ColorPicker.TabPalette('#dc-ex6', {
      color: 'yellow',
      inline: true,
      size: 'medium'
    });


    var colorpickerInsideInputAnchorInline = $('#dc-ex7-anchor').find('[data-color]');
    var colorPickerTabPaletteInsideInputInline = new ColorPicker.TabPalette('#dc-ex7', {
      color: 'pink',
      inline: true,
      size: 'small'
    });
    colorpickerInsideInputAnchorInline.css('background', colorPickerTabPaletteInsideInputInline.getColor());
    colorPickerTabPaletteInsideInputInline.on('change', function(color) {
      colorpickerInsideInputAnchorInline.css('background', color);
    });
    colorpickerInsideInputAnchorInline.on('click', function () {
      $('#dc-ex7').trigger('focus');

      return false;
    });

    var colorpickerInsideInputAnchorLeftInline = $('#dc-ex8-anchor').find('[data-color]');
    var colorPickerTabPaletteInsideInputLeftInline = new ColorPicker.TabPalette('#dc-ex8', {
      color: 'red',
      inline: true,
      size: 'small'
    });
    colorpickerInsideInputAnchorLeftInline.css('background', colorPickerTabPaletteInsideInputLeftInline.getColor());
    colorPickerTabPaletteInsideInputLeftInline.on('change', function(color) {
      colorpickerInsideInputAnchorLeftInline.css('background', color);
    });

    var colorPickerTabPaletteHiddenAnchor = new ColorPicker.TabPalette('#dc-ex9', {
      inline: true,
      anchor: {
        hidden: true
      }
    });

    var colorPickerTabPaletteHiddenArrow = new ColorPicker.TabPalette('#dc-ex10', {
      arrow: false
    });

    var dynamicAnchorCssProperty = new ColorPicker.TabPalette('#dc-ex11', {
      inline: true,
      color: 'black',
      size: 'medium',
      anchor: {
        cssProperty: 'color'
      }
    });

    $('[name=dc-ex11-anchor-css-property]').on('change', function() {
      dynamicAnchorCssProperty.setAnchorCssProperty($(this).val());
    });

    $('.colorpicker-theme').on('change', function () {
      var themUrl = $('#picker-customization').data('theme');
      $('#colorpicker-style').remove();
      themUrl = themUrl.replace('{theme}', $(this).val());
      var style = '<link id="colorpicker-style" rel="stylesheet" href="' + themUrl + '">';
      $('head').append(style);
    });

    $('.colorpicker-style').on('change', function () {
      var themUrl = $('#picker-customization').data('theme');

      $('#colorpicker-style').remove();

      var themeName = $('.colorpicker-theme:checked').val();
      var style = '';

      if ($(this).val()) {
        style += '-' + $(this).val();
      }

      themUrl = themUrl.replace('{theme}', themeName + style);

      var styleTag = '<link id="colorpicker-style" rel="stylesheet" href="' + themUrl + '">';
      $('head').append(styleTag);
    });
  });
})(jQuery);
