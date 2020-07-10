/**
 * Register the Slider block
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
  var RangeControl = wp.components.RangeControl;
  var Disabled = wp.components.Disabled;
  var PanelColorSettings = wp.blockEditor.PanelColorSettings;
  var getColorClassName = wp.blockEditor.getColorClassName;
  var withColors = wp.blockEditor.withColors;
  var htmlToElem = ( html ) => wp.element.RawHTML( { children: html } );

  registerBlockType( 'emma/slider', {
    title: 'Slider',
    description: 'A block that creates a slider using the slider javascript library.',
    icon: 'slides',
    category: 'layout',
		keywords: ['emma slider slides'],

    supports: {
			align: ['wide', 'full'],
      anchor: true,
      html: false,
		},

		attributes: {
      editorColumns: {
        type: 'number',
        default: 1,
      },
      loopType: {
        type: 'string',
        default: 'carousel',
      },
      autoplay: {
        type: 'number',
        default: '5',
      },
      itemWidth: {
        type: 'number',
        default: '',
      },
      gap: {
        type: 'number',
        default: '',
      },
      controlNav: {
        type: 'string',
        default: 'none',
      },
      showArrows: {
        type: 'boolean',
        default: true,
      },
      outerArrows: {
        type: 'boolean',
        default: false,
      },
      settingsJSON: {
        type: 'string',
        default: '',
      },
      slideCount: {
        type: 'number',
      },
      arrowColor: {
        type: 'string',
      },
		},

    edit: withColors( 'arrowColor' )( function( props ) {
      var editorColumns = props.attributes.editorColumns;
      var loopType = props.attributes.loopType;
      var autoplay = props.attributes.autoplay;
      var itemWidth = props.attributes.itemWidth;
      var gap = props.attributes.gap;
      var controlNav = props.attributes.controlNav;
      var showArrows = props.attributes.showArrows;
      var outerArrows = props.attributes.outerArrows;
      var settingsJSON = props.attributes.settingsJSON;

      var clientId = props.clientId;
      var slideCount = wp.data.select( 'core/block-editor' ).getBlocksByClientId( clientId )[0].innerBlocks.length;
      props.setAttributes( { slideCount: slideCount } );

      /**
       * Wraps a form control in a Disabled element
       * use the following format: `controlVariable = disableControl( controlVariable );`
       * @param control
       */
      function disableControl( control ) {
        var disabledControl = el(
          Disabled,
          {},
          control
        );

        return disabledControl;
      }

      function onChangeEditorColumns( newValue ) {
        props.setAttributes( { editorColumns: newValue } );
      }
      var editorColumnsControl =  el(
        RangeControl,
        {
          label: 'Columns',
          value: editorColumns,
          min: 1,
          max: 5,
          onChange: onChangeEditorColumns,
          help: "How many slides you'd like to view on each row in the editor. This has no effect on the frontend."
        }
      );

      var viewControls = el(
        PanelBody, {
          title: 'Editor Settings',
          initialOpen: true,
        },
          editorColumnsControl,
      );

      function onChangeLoopType( newValue ) {
        props.setAttributes( { loopType: newValue } );
      }
      var loopTypeControl =  el(
        RadioControl,
        {
          label: 'Loop Behavior',
          help: 'What the slider should do when it reaches the end of the slides.',
          selected: loopType,
          options: [
            {
              value: 'slider',
              label: 'Rewind to Start'
            },
            {
              value: 'carousel',
              label: 'Infinitely Rotate'
            },
            {
              value: 'end',
              label: "Don't Loop",
            },
          ],
          onChange: onChangeLoopType,
        }
      );

      function onChangeAutoplay( newValue ) {
        var newNumber = parseFloat( newValue );
        props.setAttributes( { autoplay: newNumber > 0 ? newNumber : 0 } );
      }
      var autoplayControl = el(
        TextControl,
        {
          label: "Autoplay Timer (seconds)",
          value: autoplay,
          help: 'Use 0 to disable autoplay.',
          type: 'number',
          min: 0,
          onChange: onChangeAutoplay,
        }
      );

      function onChangeItemWidth( newValue ) {
        props.setAttributes( { itemWidth: parseInt( newValue ) } );
      }
      var itemWidthControl = el(
        TextControl,
        {
          label: "Minimum Item Width (px)",
          value: itemWidth,
          help: 'Minimum width of slides. Leave empty to only show one slide at a time.',
          type: 'number',
          onChange: onChangeItemWidth,
        }
      );

      function onChangeGap( newValue ) {
        props.setAttributes( { gap: parseInt( newValue ) } );
      }
      var gapControl = el(
        TextControl,
        {
          label: 'Slide Gap (px)',
          value: gap,
          help: 'The gap (in pixels) between slides. Only relevant when multiple slides are shown at a time.',
          type: 'number',
          onChange: onChangeGap,
        }
      );

      formatControls = el(
        PanelBody, {
          title: 'Format Settings',
          initialOpen: false,
        },
        itemWidthControl,
        gapControl,
      );

      function onChangeControlNav( newValue ) {
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
          onChange: onChangeControlNav,
        }
      );

      function onChangeShowArrows( newValue ) {
        props.setAttributes( { showArrows: newValue } );
      }
      var showArrowsControl = el(
        ToggleControl,
        {
          label: 'Prev/Next Navigation',
          checked: showArrows,
          help: 'Activates the left/right navigation arrows.',
          onChange: onChangeShowArrows,
        }
      );

      function onChangeOuterArrows( newValue ) {
        props.setAttributes( { outerArrows: newValue } );
      }
      var outerArrowsControl = '';
      if( showArrows ) {
        outerArrowsControl = el(
          ToggleControl,
          {
            label: 'Outer Navigation',
            checked: outerArrows,
            help: 'Adds side margin to slider so arrows are outside of slides.',
            onChange: onChangeOuterArrows,
          }
        );
      }

      var colorControls = '';
      if( showArrows ) {
      colorControls = el(
          PanelColorSettings, {
            title: 'Colors',
            disableCustomColors: true,
            initialOpen: false,
            colorSettings: [
              {
                label: 'Navigation Arrow Color',
                value: props.arrowColor.color,
                onChange: props.setArrowColor,
              },
            ]
          }
        )
      }

      var navigationControls = el(
        PanelBody, {
          title: 'Navigation Settings',
          initialOpen: true,
        },
          showArrowsControl,
          outerArrowsControl,
          controlNavControl,
      );

      var generalControls = el(
        PanelBody, {
          title: 'General Settings',
          initialOpen: true,
        },
          loopTypeControl,
          autoplayControl,
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
            help: htmlToElem( 'Enter JSON properties for additional settings found <a href="https://glidejs.com/docs/options/" target="_blank">here</a>. Make sure there are not quotes around numeric values!' ),
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
            viewControls,
            generalControls,
            navigationControls,
            formatControls,
            colorControls,
            settingsJSONControl
          ),
          el(
            'div', { className: props.className + " columns-" + props.attributes.editorColumns },
            el( InnerBlocks, {
              allowedBlocks: ['emma/slide'],
            } ),
          ),
        )
      );
    } ),

    save: function( props ) {
      var a = props.attributes;
      var settings = {};
      var wrapperClasses = "glide__wrapper " + ( getColorClassName( 'arrow-color', a.arrowColor ) || '' );

      /**
       * Check if object is valid JSON
       * @param str
       */
      function isJSONString( str ) {
        try {
          JSON.parse( str );
        } catch( e ) {
          return false;
        }
        return true;
      }

      // set loopType setting
      if( a.loopType == 'end' ) {
        settings.rewind = false;
      } else {
        settings.type = a.loopType;
      }

      // set autoplay setting
      //settings.autoplay = Number.isFinite( a.autoplay ) ? a.autoplay : 0;
      if( a.autoplay > 0 ) {
        settings.autoplay = ( a.autoplay * 1000 );
      }

      // set minimum slide width for responsive carousels
      if( a.itemWidth > 0 ) {
        settings.itemWidth = a.itemWidth;
      }

      // set slide gap for multi-slide layouts
      if( a.gap > 0 ) {
        settings.gap = a.gap;
      }

      // generate markup for arrow nav if active
      var arrowNav = '';
      if( a.showArrows ) {
        arrowNav = el('div', {
          className: "glide__arrows",
          "data-glide-el": "controls",
        },
          el('a', {
            href: "#",
            className: "glide-control glide-control__previous",
            "data-glide-dir": "<"
          },
            el( 'span', {
              className: 'screen-reader-text'
            },
              "Previous"
            ),
          ),
          el('a', {
            href: "#",
            className: "glide-control glide-control__next",
            "data-glide-dir": ">"
          },
            el( 'span', {
              className: 'screen-reader-text'
            },
              "Next"
            )
          )
        );

        if( a.outerArrows ) {
          wrapperClasses += " outer-glide-control";
        }
      }

      // generate markup for bullet nav if active
      var bulletNav = "";
      var slideCount = a.slideCount;
      if( a.controlNav == 'dots' ) {
        wrapperClasses += ' dot-nav';
        var bullets = [];
        for( let i = 0; i < slideCount; i++ ) {
          bullets.push(
            el( 'a', {
              href: "#",
              className: "glide__bullet",
              "data-glide-dir": "=" + i,
            },
              el( 'span', {
                className: 'screen-reader-text'
              },
                "Slide " + i
              )
            )
          );
        }
        bulletNav = el( 'div', {
          className: "glide__bullets",
          "data-glide-el": "controls[nav]",
        },
          bullets,
        );
      }

      // add manual settings
      var manualSettings = "{" + a.settingsJSON + "}";
      if( isJSONString( manualSettings ) ) {
        Object.assign( settings, JSON.parse( manualSettings ) );
      }

      return (
        el('div', {
          className: wrapperClasses,
        },
          el('div', {
            className: "glide__main",
            'data-slider-settings': JSON.stringify( settings ),
          },
            el('div', {
              className: "glide__track",
              'data-glide-el': 'track',
            },
              el('ul', {
                className: 'slider__inner-container glide__slides'
              },
                el( InnerBlocks.Content, null )
              )
            ),
            arrowNav,
            bulletNav,
          )
        )
      )
    }
	} );
} ) (
  window.wp.editor,
  window.wp.element
);

/**
 * Register the Slide child block (child of Slider)
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
    parent: [ 'emma/slider' ],
    description: 'A child block of emma/slider.',
    icon: 'slides',
    category: 'layout',
		keywords: ['emma slider slides'],

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
            el( InnerBlocks, {
              allowedBlocks: wp.blocks.getBlockTypes().map(block => block.name).filter(blockName => blockName !== 'emma/slider' && blockName != 'emma/slide'),
            } ),
          ),
        )
      );
    },

    save: function( props ) {
      return (
        el( 'li', { className: "glide__slide", 'data-thumb': props.attributes.thumbnailURL },
          el( InnerBlocks.Content, null )
        )
      );
    }
	} );
} ) (
  window.wp.editor,
  window.wp.element
);
