(function ($) {
  'use strict';

  $(document).ready(function() {
    var colorPickerDefault = new ColorPicker.Default('#dc-ex1', {

    });
    colorPickerDefault.on('change', function (picker, color) {
      //console.log(picker);
      console.log(color);
    });

    var colorPickerDefaultCustomAnchor = new ColorPicker.Default('#dc-ex2', {
      color: 'green'
    });

    var colorpickerInsideInputAnchor = $('#dc-ex3-anchor').find('[data-color]');
    var colorPickerDefaultInsideInput = new ColorPicker.Default('#dc-ex3', {
      color: 'blue'
    });
    colorpickerInsideInputAnchor.css('background', colorPickerDefaultInsideInput.getColor());
    colorPickerDefaultInsideInput.on('change', function(color) {
      colorpickerInsideInputAnchor.css('background', color);
    });
    colorpickerInsideInputAnchor.on('click', function () {
      $('#dc-ex3').trigger('focus');

      return false;
    });

    var colorpickerInsideInputAnchorLeft = $('#dc-ex4-anchor').find('[data-color]');
    var colorPickerDefaultInsideInputLeft = new ColorPicker.Default('#dc-ex4', {
      color: 'purple'
    });
    colorpickerInsideInputAnchorLeft.css('background', colorPickerDefaultInsideInputLeft.getColor());
    colorPickerDefaultInsideInputLeft.on('change', function(color) {
      colorpickerInsideInputAnchorLeft.css('background', color);
    });

    var colorPickerDefaultInline = new ColorPicker.Default('#dc-ex5', {
      inline: true
    });

    var colorPickerDefaultCustomAnchorInline = new ColorPicker.Default('#dc-ex6', {
      color: 'yellow',
      inline: true,
      size: 'medium'
    });


    var colorpickerInsideInputAnchorInline = $('#dc-ex7-anchor').find('[data-color]');
    var colorPickerDefaultInsideInputInline = new ColorPicker.Default('#dc-ex7', {
      color: 'pink',
      inline: true,
      size: 'small'
    });
    colorpickerInsideInputAnchorInline.css('background', colorPickerDefaultInsideInputInline.getColor());
    colorPickerDefaultInsideInputInline.on('change', function(color) {
      colorpickerInsideInputAnchorInline.css('background', color);
    });
    colorpickerInsideInputAnchorInline.on('click', function () {
      $('#dc-ex7').trigger('focus');

      return false;
    });

    var colorpickerInsideInputAnchorLeftInline = $('#dc-ex8-anchor').find('[data-color]');
    var colorPickerDefaultInsideInputLeftInline = new ColorPicker.Default('#dc-ex8', {
      color: 'red',
      inline: true,
      size: 'small'
    });
    colorpickerInsideInputAnchorLeftInline.css('background', colorPickerDefaultInsideInputLeftInline.getColor());
    colorPickerDefaultInsideInputLeftInline.on('change', function(color) {
      colorpickerInsideInputAnchorLeftInline.css('background', color);
    });

    var colorPickerDefaultHiddenAnchor = new ColorPicker.Default('#dc-ex9', {
      inline: true,
      anchor: {
        hidden: true
      }
    });

    var colorPickerDefaultHiddenArrow = new ColorPicker.Default('#dc-ex10', {
      arrow: false
    });

    var dynamicAnchorCssProperty = new ColorPicker.Default('#dc-ex11', {
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

    var colorPickerDefaultHiddenInfo = new ColorPicker.Default('#dc-ex12', {
      hideInfo: true
    });

    var colorPickerDefaultHiddenHistory = new ColorPicker.Default('#dc-ex13', {
      placement: 'top',
      history: {
        hidden: true
      }
    });
  });
})(jQuery);
