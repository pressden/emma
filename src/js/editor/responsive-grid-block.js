/**
 * Register the Responsive Grid block
 */

(function (editor, element) {
	var el = element.createElement;
	var registerBlockType = wp.blocks.registerBlockType;
	var Fragment = wp.element.Fragment;
	var InnerBlocks = wp.blockEditor.InnerBlocks;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var ToggleControl = wp.components.ToggleControl;
	var Disabled = wp.components.Disabled;

	registerBlockType("emma/responsive-grid", {
		title: "Responsive Grid",
		description:
			"A block to help you easily make a responsive grid with varying column sizes available",
		icon: "grid-view",
		category: "layout",
		keywords: ["emma grid columns responsive"],

		supports: {
			align: ["wide", "full"],
			anchor: true,
			html: false,
		},

		attributes: {
			minColumnWidth: {
				type: "string",
				default: "col-md",
			},
			columnGap: {
				type: "string",
				default: "col-gap-md",
			},
			rowGap: {
				type: "string",
				default: "row-gap-md",
			},
			xAlignment: {
				type: "string",
				default: "x-stretch",
			},
			yAlignment: {
				type: "string",
				default: "y-stretch",
			},
			imageFill: {
				type: "boolean",
				default: true,
			},
		},

		edit: function (props) {
			var minColumnWidth = props.attributes.minColumnWidth;
			var columnGap = props.attributes.columnGap;
			var rowGap = props.attributes.rowGap;
			var xAlignment = props.attributes.xAlignment;
			var yAlignment = props.attributes.yAlignment;
			var imageFill = props.attributes.imageFill;
			var classes =
				props.className +
				" " +
				minColumnWidth +
				" " +
				columnGap +
				" " +
				rowGap +
				" " +
				xAlignment +
				" " +
				yAlignment;

			/**
			 * Wraps a form control in a Disabled element
			 * use the following format: `controlVariable = disableControl( controlVariable );`
			 * @param control
			 */
			function disableControl(control) {
				var disabledControl = el(Disabled, {}, control);

				return disabledControl;
			}

			function onChangeMinColumnWidth(newValue) {
				props.setAttributes({ minColumnWidth: newValue });
			}
			function onChangeColumnGap(newValue) {
				props.setAttributes({ columnGap: newValue });
			}
			function onChangeRowGap(newValue) {
				props.setAttributes({ rowGap: newValue });
			}
			function onChangeXAlignment(newValue) {
				props.setAttributes({ xAlignment: newValue });
			}
			function onChangeYAlignment(newValue) {
				props.setAttributes({ yAlignment: newValue });
			}
			function onChangeImageFill(newValue) {
				props.setAttributes({ imageFill: newValue });
			}

			var imageFillControl = el(ToggleControl, {
				label: "Image Fill",
				help: "Extends images in the cell to cover any spare vertical space. Images will be horizontally-cropped as-needed to maintain aspect ratio. Requires Vertical Alignment to be set to Stretch",
				checked: imageFill,
				onChange: onChangeImageFill,
			});
			if (yAlignment != "y-stretch") {
				imageFillControl = disableControl(imageFillControl);
			}

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{},
						el(SelectControl, {
							label: "Minimum Column Width",
							value: minColumnWidth,
							options: [
								{
									value: "col-xs",
									label: "Extra Small",
								},
								{
									value: "col-sm",
									label: "Small",
								},
								{
									value: "col-md",
									label: "Medium",
								},
								{
									value: "col-lg",
									label: "Large",
								},
								{
									value: "col-xl",
									label: "Extra Large",
								},
							],
							onChange: onChangeMinColumnWidth,
						}),
						el(SelectControl, {
							label: "Gap Between Columns",
							value: columnGap,
							options: [
								{
									value: "col-gap-none",
									label: "None",
								},
								{
									value: "col-gap-xs",
									label: "Extra Small",
								},
								{
									value: "col-gap-sm",
									label: "Small",
								},
								{
									value: "col-gap-md",
									label: "Medium",
								},
								{
									value: "col-gap-lg",
									label: "Large",
								},
								{
									value: "col-gap-xl",
									label: "Extra Large",
								},
							],
							onChange: onChangeColumnGap,
						}),
						el(SelectControl, {
							label: "Gap Between Rows",
							value: rowGap,
							options: [
								{
									value: "row-gap-none",
									label: "None",
								},
								{
									value: "row-gap-xs",
									label: "Extra Small",
								},
								{
									value: "row-gap-sm",
									label: "Small",
								},
								{
									value: "row-gap-md",
									label: "Medium",
								},
								{
									value: "row-gap-lg",
									label: "Large",
								},
								{
									value: "row-gap-xl",
									label: "Extra Large",
								},
							],
							onChange: onChangeRowGap,
						}),
						el(SelectControl, {
							label: "Horizontal Alignment",
							help: "Sets how content within each grid container should be justified horizontally.",
							value: xAlignment,
							options: [
								{
									value: "x-start",
									label: "Left",
								},
								{
									value: "x-center",
									label: "Center",
								},
								{
									value: "x-end",
									label: "Right",
								},
								{
									value: "x-stretch",
									label: "Stretch",
								},
							],
							onChange: onChangeXAlignment,
						}),
						el(SelectControl, {
							label: "Vertical Alignment",
							help: "Sets how content within each grid container should be justified vertically.",
							value: yAlignment,
							options: [
								{
									value: "y-start",
									label: "Top",
								},
								{
									value: "y-center",
									label: "Center",
								},
								{
									value: "y-end",
									label: "Bottom",
								},
								{
									value: "y-stretch",
									label: "Stretch",
								},
							],
							onChange: onChangeYAlignment,
						}),
						imageFillControl
					)
				),
				el(
					"div",
					{ className: classes },
					el(InnerBlocks, {
						allowedBlocks: ["emma/grid-cell"],
					})
				)
			);
		},

		save: function (props) {
			var classes =
				props.attributes.minColumnWidth +
				" " +
				props.attributes.columnGap +
				" " +
				props.attributes.rowGap +
				" " +
				props.attributes.xAlignment +
				" " +
				props.attributes.yAlignment +
				" " +
				(props.attributes.imageFill &&
				props.attributes.yAlignment == "y-stretch"
					? "image-fill"
					: "");
			return el("div", { className: classes }, el(InnerBlocks.Content, null));
		},
	});
})(window.wp.editor, window.wp.element);

/**
 * Register the Grid Cell block (child of Responsive Grid)
 */
(function (editor, element) {
	var el = element.createElement;
	var registerBlockType = wp.blocks.registerBlockType;
	var Fragment = wp.element.Fragment;
	var InnerBlocks = wp.blockEditor.InnerBlocks;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;

	registerBlockType("emma/grid-cell", {
		title: "Grid Cell",
		parent: ["emma/responsive-grid"],
		description: "A child block of emma/responsive-grid.",
		icon: "screenoptions",
		category: "layout",
		keywords: ["emma grid columns responsive"],

		supports: {
			html: false,
		},

		attributes: {
			xAlignment: {
				type: "string",
			},
			yAlignment: {
				type: "string",
			},
		},

		edit: function (props) {
			var xAlignment = props.attributes.xAlignment || "";
			var yAlignment = props.attributes.yAlignment || "";

			function onChangeXAlignment(newValue) {
				props.setAttributes({ xAlignment: newValue });
			}
			var xAlignmentControl = el(SelectControl, {
				label: "Horizontal Alignment",
				help: "Sets how content within each grid container should be justified horizontally.",
				value: xAlignment,
				options: [
					{
						value: "",
						label: "Default",
					},
					{
						value: "x-start",
						label: "Left",
					},
					{
						value: "x-center",
						label: "Center",
					},
					{
						value: "x-end",
						label: "Right",
					},
					{
						value: "x-stretch",
						label: "Stretch",
					},
				],
				onChange: onChangeXAlignment,
			});

			function onChangeYAlignment(newValue) {
				props.setAttributes({ yAlignment: newValue });
			}
			var yAlignmentControl = el(SelectControl, {
				label: "Vertical Alignment",
				help: "Sets how content within each grid container should be justified vertically.",
				value: yAlignment,
				options: [
					{
						value: "",
						label: "Default",
					},
					{
						value: "y-start",
						label: "Top",
					},
					{
						value: "y-center",
						label: "Center",
					},
					{
						value: "y-end",
						label: "Bottom",
					},
					{
						value: "y-stretch",
						label: "Stretch",
					},
				],
				onChange: onChangeYAlignment,
			});

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(PanelBody, {}, xAlignmentControl, yAlignmentControl)
				),
				el("div", { className: props.className }, el(InnerBlocks))
			);
		},

		save: function (props) {
			var xAlignment = "";
			var yAlignment = "";

			if (props.attributes.xAlignment && props.attributes.xAlignment != "") {
				xAlignment = " " + props.attributes.xAlignment;
			}
			if (props.attributes.yAlignment && props.attributes.yAlignment != "") {
				yAlignment = " " + props.attributes.yAlignment;
			}

			var classes = xAlignment + " " + yAlignment;

			return el("div", { className: classes }, el(InnerBlocks.Content, null));
		},
	});
})(window.wp.editor, window.wp.element);

/**
 * Hook into Grid Cell block to add classes to the wrapper div
 */
var el = wp.element.createElement;
var withClientIdClassName = wp.compose.createHigherOrderComponent(function (
	BlockListBlock
) {
	return function (props) {
		if ("emma/grid-cell" === props.name) {
			var xAlignment = "";
			var yAlignment = "";

			if (props.attributes.xAlignment && props.attributes.xAlignment != "") {
				xAlignment = " " + props.attributes.xAlignment;
			}
			if (props.attributes.yAlignment && props.attributes.yAlignment != "") {
				yAlignment = " " + props.attributes.yAlignment;
			}

			var classes = xAlignment + yAlignment;
			props.className += classes;
		}
		return el(BlockListBlock, props);
	};
},
"withClientIdClassName");

wp.hooks.addFilter(
	"editor.BlockListBlock",
	"emma/grid-cell",
	withClientIdClassName
);
