/**
 * Register the Flexslider block
 */

(function( editor, element ) {

  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
	var Fragment = wp.element.Fragment;
  var InnerBlocks = wp.blockEditor.InnerBlocks;
	var InspectorControls = wp.blockEditor.InspectorControls;
  var PanelBody = wp.components.PanelBody;
  var RadioControl = wp.components.RadioControl;
  var ToggleControl = wp.components.ToggleControl;
  var TextareaControl = wp.components.TextareaControl;
  var TextControl = wp.components.TextControl;
  var Disabled = wp.components.Disabled;
  var htmlToElem = ( html ) => wp.element.RawHTML( { children: html } );

  registerBlockType( 'emma/flexslider', {
    title: 'Flexslider',
    description: 'A block that creates a slider using the flexslider javascript library.',
    icon: 'slides',
    category: 'layout',
		keywords: ['emma slider flexslider slides'],

    supports: {
			align: ['wide', 'full'],
      anchor: true,
      html: false,
		},

		attributes: {
      sliderType: {
        type: 'string',
      },
      fullItems: {
        type: 'boolean',
      },
      itemWidth: {
        type: 'string',
      },
      itemMargin: {
        type: 'string',
      },
      animationType: {
        type: 'string',
      },
      controlNav: {
        type: 'string',
      },
      showArrows: {
        type: 'boolean',
      },
      settingsJSON: {
        type: 'string',
      }
		},

    edit: function( props ) {
      var sliderType = props.attributes.sliderType || 'slider';
      var fullItems = props.attributes.fullItems == undefined ? true : props.attributes.fullItems;
      var itemWidth = props.attributes.itemWidth || 200;
      var itemMargin = props.attributes.itemMargin || 15;
      var animationType = props.attributes.animationType || 'fade';
      var controlNav = props.attributes.controlNav || "none";
      var showArrows = props.attributes.showArrows || false;
      var settingsJSON = props.attributes.settingsJSON || '';

      function disableControl( control ) {
        var disabledControl = el(
          Disabled,
          {},
          control
        );

        return disabledControl;
      }

      function onChangeSliderType( newValue ) {
        props.setAttributes( { sliderType: newValue } );
        props.setAttributes( { animationType: 'slide' } );
      }
      var sliderTypeControl =  el(
        RadioControl,
        {
          label: 'Type',
          selected: sliderType,
          options: [
            {
              value: 'slider',
              label: 'Slider (one item at a time)'
            },
            {
              value: 'carousel',
              label: 'Carousel (multiple items at a time)'
            },
          ],
          onChange: onChangeSliderType,
        }
      );

      function onChangefullItems( newValue ) {
        props.setAttributes( { fullItems: newValue } );
      }
      var fullItemsControl =  el(
        ToggleControl,
        {
          label: 'Show Only Full Items',
          checked: fullItems,
          help: 'Resizes items dynamically to prevent partials',
          onChange: onChangefullItems,
        }
      );

      function onChangeItemWidth( newValue ) {
        props.setAttributes( { itemWidth: newValue } );
      }
      var itemWidthLabel = fullItems ? "Minimum Item Width (px)" : "Item Width (px)";
      var itemWidthControl = el(
        TextControl,
        {
          label: itemWidthLabel,
          value: itemWidth,
          help: 'The width (in pixels) of the carousel items; this acts as the minimum item width when "Full Items" is selected',
          type: 'number',
          onChange: onChangeItemWidth,
        }
      );

      function onChangeItemMargin( newValue ) {
        props.setAttributes( { itemMargin: newValue } );
      }
      var itemMarginControl = el(
        TextControl,
        {
          label: 'Item Margin (px)',
          value: itemMargin,
          help: 'The margin (in pixels) between carousel items',
          type: 'number',
          onChange: onChangeItemMargin,
        }
      );

      var carouselControls = null;
      if( sliderType == 'carousel' ) {
        carouselControls = el(
          PanelBody, {
            title: 'Carousel Settings',
            initialOpen: false,
          },
          fullItemsControl,
          itemWidthControl,
          itemMarginControl,
        );
      }

      function onChangeAnimationType( newValue ) {
        props.setAttributes( { animationType: newValue } );
      }
      var animationTypeControl =  el(
        RadioControl,
        {
          label: 'Animation',
          selected: animationType,
          help: 'For a carousel slider, Slide animation is required.',
          options: [
            {
              value: 'fade',
              label: 'Fade'
            },
            {
              value: 'slide',
              label: 'Slide'
            },
          ],
          onChange: onChangeAnimationType,
        }
      );
      if( sliderType == 'carousel' ) {
        animationTypeControl = disableControl( animationTypeControl );
      }

      function onChangecontrolNav( newValue ) {
        props.setAttributes( { controlNav: newValue } );
      }
      var controlNavControl =  el(
        RadioControl,
        {
          label: 'Control Navigation',
          selected: controlNav,
          help: 'Determines what type of slide navigation will appear underneath the slider.',
          options: [
            {
              value: 'none',
              label: 'None'
            },
            {
              value: 'dots',
              label: 'Dots',
            },
            // {
            //   value: 'thumbnails',
            //   label: 'Thumbnails'
            // },
          ],
          onChange: onChangecontrolNav,
        }
      );

      function onChangeshowArrows( newValue ) {
        props.setAttributes( { showArrows: newValue } );
      }
      var showArrowsControl =  el(
        ToggleControl,
        {
          label: 'Always Show Nav',
          checked: showArrows,
          help: 'Makes the left/right navigation arrows always visible (not just on hover).',
          onChange: onChangeshowArrows,
        }
      );

      function onChangeSettingsJSON( newValue ) {
        props.setAttributes( { settingsJSON: newValue } );
      }
      var settingsJSONControl =  el(
        PanelBody, {
          title: 'Manual Settings',
          initialOpen: false,
        }, el(
          TextareaControl,
          {
            value: settingsJSON,
            help: htmlToElem( 'Enter JSON properties for additional settings found <a href="https://github.com/woocommerce/FlexSlider/wiki/FlexSlider-Properties" target="_blank">here</a>. Make sure there are not quotes around numeric values!' ),
            onChange: onChangeSettingsJSON,
            placeholder: '"setting1":"value1",\n"setting2":"value2",\n"numberSetting":1234',
          }
        )
      );

      return (
        el(
          Fragment,
          null,
          el(
            InspectorControls,
            null,
            el(
              PanelBody,
              {},
              sliderTypeControl,
              animationTypeControl,
              controlNavControl,
              showArrowsControl,
              carouselControls,
              settingsJSONControl
            ),
          ),
          el(
            'div', { className: props.className },
            el( InnerBlocks, {
              allowedBlocks: ['emma/slide'],
            } ),
          ),
        )
      );
    },

    save: function( props ) {
      var a = props.attributes;
      var settings = {}

      function isJSONString( str ) {
        try {
          JSON.parse( str );
        } catch( e ) {
          return false;
        }
        return true;
      }

      var classes = props.className;
      if( a.showArrows ) {
        classes += " show-arrows";
      }

      if( a.sliderType == 'carousel' ) {
        settings.itemWidth = parseInt( a.itemWidth );
        settings.itemMargin = parseInt( a.itemMargin );
        if( a.fullItems ) {
          settings.fullItems = true;
        }
      }
      if( a.animationType != 'fade' ) {
        settings.animation = a.animationType;
      }
      if( a.controlNav == "thumbnails" ) {
        settings.controlNav = "thumbnails";
      } else if ( a.controlNav == "dots" ) {
        classes += " dot-control-nav";
      } else if ( a.controlNav == "none" ) {
        settings.controlNav = false;
      }
      var manualSettings = "{" + a.settingsJSON + "}";
      if( isJSONString( manualSettings ) ) {
        Object.assign( settings, JSON.parse( manualSettings ) );
      }

      return (
        el('div', {
            className: classes + " flexslider",
            'data-flexslider-settings': JSON.stringify( settings ),
          },
          el('ul', { className: 'flexslider__inner-container slides' },
            el( InnerBlocks.Content, null )
          )
        )
      );
    }
	} );
} ) (
  window.wp.editor,
  window.wp.element
);

/**
 * Register the Slide child block (child of Flexslider)
 */

(function( editor, element ) {

  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
	var Fragment = wp.element.Fragment;
  var InnerBlocks = wp.blockEditor.InnerBlocks;
  var InspectorControls = wp.blockEditor.InspectorControls;
  var PanelBody = wp.components.PanelBody;
  var MediaUpload = wp.blockEditor.MediaUpload;
  var Button = wp.components.Button;
  var BaseControl = wp.components.BaseControl;
  var IconButton = wp.components.IconButton;

  registerBlockType( 'emma/slide', {
    title: 'Slide',
    parent: [ 'emma/flexslider' ],
    description: 'A child block of emma/flexslider.',
    icon: 'slides',
    category: 'layout',
		keywords: ['emma slider flexslider slides'],

    supports: {
      html: false,
    },

    attributes: {
      thumbnailID: {
				type: 'number',
			},
			thumbnailURL: {
				type: 'string',
				source: 'attribute',
				selector: 'li',
				attribute: 'data-thumb',
			},
		},

    edit: function( props ) {
      var thumbnailID = props.attributes.thumbnailID;
      var thumbnailURL = props.attributes.thumbnailURL;

      function onSelectThumbnail( thumbnail ) {
        alert( Object.keys( thumbnail ) );
        return props.setAttributes( {
          thumbnailID: thumbnail.id,
          thumbnailURL: thumbnail.url,
        } );
      }
      var thumbnailControl =  el( PanelBody, {
          title: 'Slide Thumbnail',
          initialOpen: true,
        },
        el( BaseControl, {},
          el(
            MediaUpload,
            {
              label: "Thumbnail",
              help: "test",
              onSelect: onSelectThumbnail,
              allowedTypes: [ 'image' ],
              value: thumbnailID,
              render: function( obj ) {
                return el( Button, {
                    className: 'button button-large components-base-control__field',
                    onClick: obj.open,
                  },
                  'Select Thumbnail',
                );
              }
            }
          ),
          el(
            'div',
            {
              className: 'components-base-control__help'
            },
            'For sliders using thumbnail navigation, this image will override the default thumbnail image for this slide.'
          ),
        ),
        thumbnailID ? (
          el( 'div', {},
            el( IconButton, { icon: 'dismiss' } ),
            el( 'img', { src: props.attributes.thumbnailURL } )
          )
        ) : '',
      );


      return (
        el(
          Fragment,
          null,
          el(
            InspectorControls,
            null,
            thumbnailControl,
          ),
          el( 'div', { className: props.className, 'data-thumb': props.attributes.thumbnailURL },
            el( InnerBlocks ),
          ),
        )
      );
    },

    save: function( props ) {
      return (
        el( 'li', { className: props.className, 'data-thumb': props.attributes.thumbnailURL },
          el( InnerBlocks.Content, null )
        )
      );
    }
	} );
} ) (
  window.wp.editor,
  window.wp.element
);
