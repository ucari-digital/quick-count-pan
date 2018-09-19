(function ($) {
  'use strict';

  $(document).ready(function() {
    var colorPickerPalette = new ColorPicker.Palette('#dc-ex1', {

    });

    var colorPickerPaletteCustomAnchor = new ColorPicker.Palette('#dc-ex2', {
      color: 'green'
    });

    var colorpickerInsideInputAnchor = $('#dc-ex3-anchor').find('[data-color]');
    var colorPickerPaletteInsideInput = new ColorPicker.Palette('#dc-ex3', {
      color: 'blue'
    });
    colorpickerInsideInputAnchor.css('background', colorPickerPaletteInsideInput.getColor());
    colorPickerPaletteInsideInput.on('change', function(color) {
      colorpickerInsideInputAnchor.css('background', color);
    });
    colorpickerInsideInputAnchor.on('click', function () {
      $('#dc-ex3').trigger('focus');

      return false;
    });

    var colorpickerInsideInputAnchorLeft = $('#dc-ex4-anchor').find('[data-color]');
    var colorPickerPaletteInsideInputLeft = new ColorPicker.Palette('#dc-ex4', {
      color: 'purple'
    });
    colorpickerInsideInputAnchorLeft.css('background', colorPickerPaletteInsideInputLeft.getColor());
    colorPickerPaletteInsideInputLeft.on('change', function(color) {
      colorpickerInsideInputAnchorLeft.css('background', color);
    });

    var colorPickerPaletteInline = new ColorPicker.Palette('#dc-ex5', {
      inline: true
    });

    var colorPickerPaletteCustomAnchorInline = new ColorPicker.Palette('#dc-ex6', {
      color: 'yellow',
      inline: true,
      size: 'medium'
    });


    var colorpickerInsideInputAnchorInline = $('#dc-ex7-anchor').find('[data-color]');
    var colorPickerPaletteInsideInputInline = new ColorPicker.Palette('#dc-ex7', {
      color: 'pink',
      inline: true,
      size: 'small'
    });
    colorpickerInsideInputAnchorInline.css('background', colorPickerPaletteInsideInputInline.getColor());
    colorPickerPaletteInsideInputInline.on('change', function(color) {
      colorpickerInsideInputAnchorInline.css('background', color);
    });
    colorpickerInsideInputAnchorInline.on('click', function () {
      $('#dc-ex7').trigger('focus');

      return false;
    });

    var colorpickerInsideInputAnchorLeftInline = $('#dc-ex8-anchor').find('[data-color]');
    var colorPickerPaletteInsideInputLeftInline = new ColorPicker.Palette('#dc-ex8', {
      color: 'red',
      inline: true,
      size: 'small'
    });
    colorpickerInsideInputAnchorLeftInline.css('background', colorPickerPaletteInsideInputLeftInline.getColor());
    colorPickerPaletteInsideInputLeftInline.on('change', function(color) {
      colorpickerInsideInputAnchorLeftInline.css('background', color);
    });

    var colorPickerPaletteHiddenAnchor = new ColorPicker.Palette('#dc-ex9', {
      inline: true,
      anchor: {
        hidden: true
      }
    });

    var colorPickerPaletteHiddenArrow = new ColorPicker.Palette('#dc-ex10', {
      arrow: false
    });

    var dynamicAnchorCssProperty = new ColorPicker.Palette('#dc-ex11', {
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
