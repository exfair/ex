( function( api ) {

	api.sectionConstructor['fasto_pro'] = api.Section.extend( {

		attachEvents: function () {},

		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
