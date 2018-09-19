(function ($) {
  'use strict';

  $(document).ready(function() {
    var colorPickerMultiSpectral = new ColorPicker.MultiSpectral('#dc-ex1', {

    });

    var colorPickerMultiSpectralCustomAnchor = new ColorPicker.MultiSpectral('#dc-ex2', {
      color: 'green'
    });

    var colorpickerInsideInputAnchor = $('#dc-ex3-anchor').find('[data-color]');
    var colorPickerMultiSpectralInsideInput = new ColorPicker.MultiSpectral('#dc-ex3', {
      color: 'blue'
    });
    colorpickerInsideInputAnchor.css('background', colorPickerMultiSpectralInsideInput.getColor());
    colorPickerMultiSpectralInsideInput.on('change', function(color) {
      colorpickerInsideInputAnchor.css('background', color);
    });
    colorpickerInsideInputAnchor.on('click', function () {
      $('#dc-ex3').trigger('focus');

      return false;
    });

    var colorpickerInsideInputAnchorLeft = $('#dc-ex4-anchor').find('[data-color]');
    var colorPickerMultiSpectralInsideInputLeft = new ColorPicker.MultiSpectral('#dc-ex4', {
      color: 'purple'
    });
    colorpickerInsideInputAnchorLeft.css('background', colorPickerMultiSpectralInsideInputLeft.getColor());
    colorPickerMultiSpectralInsideInputLeft.on('change', function(color) {
      colorpickerInsideInputAnchorLeft.css('background', color);
    });

    var colorPickerMultiSpectralInline = new ColorPicker.MultiSpectral('#dc-ex5', {
      inline: true
    });

    var colorPickerMultiSpectralCustomAnchorInline = new ColorPicker.MultiSpectral('#dc-ex6', {
      color: 'yellow',
      inline: true,
      size: 'medium'
    });


    var colorpickerInsideInputAnchorInline = $('#dc-ex7-anchor').find('[data-color]');
    var colorPickerMultiSpectralInsideInputInline = new ColorPicker.MultiSpectral('#dc-ex7', {
      color: 'pink',
      inline: true,
      size: 'small'
    });
    colorpickerInsideInputAnchorInline.css('background', colorPickerMultiSpectralInsideInputInline.getColor());
    colorPickerMultiSpectralInsideInputInline.on('change', function(color) {
      colorpickerInsideInputAnchorInline.css('background', color);
    });
    colorpickerInsideInputAnchorInline.on('click', function () {
      $('#dc-ex7').trigger('focus');

      return false;
    });

    var colorpickerInsideInputAnchorLeftInline = $('#dc-ex8-anchor').find('[data-color]');
    var colorPickerMultiSpectralInsideInputLeftInline = new ColorPicker.MultiSpectral('#dc-ex8', {
      color: 'red',
      inline: true,
      size: 'small'
    });
    colorpickerInsideInputAnchorLeftInline.css('background', colorPickerMultiSpectralInsideInputLeftInline.getColor());
    colorPickerMultiSpectralInsideInputLeftInline.on('change', function(color) {
      colorpickerInsideInputAnchorLeftInline.css('background', color);
    });

    var colorPickerMultiSpectralHiddenAnchor = new ColorPicker.MultiSpectral('#dc-ex9', {
      inline: true,
      anchor: {
        hidden: true
      }
    });

    var colorPickerMultiSpectralHiddenArrow = new ColorPicker.MultiSpectral('#dc-ex10', {
      arrow: false
    });

    var dynamicAnchorCssProperty = new ColorPicker.MultiSpectral('#dc-ex11', {
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
      var val = $(this).val();
      var style = '<link id="colorpicker-style" rel="stylesheet" href="' + val + '">';
      $('head').append(style);
    });

    var colorPickerMultiSpectralHiddenHistory = new ColorPicker.MultiSpectral('#dc-ex12', {
      placement: 'top',
      history: {
        hidden: true
      }
    });
  });
})(jQuery);
