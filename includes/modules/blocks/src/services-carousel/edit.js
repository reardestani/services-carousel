import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import {
    __experimentalNumberControl as NumberControl,
    SelectControl,
    BaseControl,
    __experimentalHStack as HStack,
    PanelBody,
} from '@wordpress/components';
import './editor.scss';

export default function Edit( { attributes, setAttributes, clientId } ) {
    const blockProps = useBlockProps( {
        className: `svcl-container`
    } );

    const {
        postsPerPage,
        displayOrder,
        categories,
        minPrice,
        maxPrice
    } = attributes;

    // Service Categories.
    const serviceCategories = useSelect( ( select ) => {
        return select( 'core' ).getEntityRecords( 'taxonomy', 'svcl_service_category' );
    } );

    let categoriesOptions = [];

    if ( serviceCategories ) {
        serviceCategories.forEach( ( category ) => {
            categoriesOptions.push( { value : category.id, label : category.name } )
        })
    } else {
        categoriesOptions.push( { value: 0, label: 'Loading...' } )
    }

    function onChangeServicesNumber( newContent ) {
        setAttributes( { postsPerPage: newContent } );
    }

    function onChangeDisplayOrder( newValue ) {
        setAttributes( { displayOrder: newValue } );
    }

    function onChangeCategories( newValue ) {
        setAttributes( { categories: newValue } );
    }

    function onChangeMinPrice( newValue ) {
        setAttributes( { minPrice: newValue } );
    }

    function onChangeMaxPrice( newValue ) {
        setAttributes( { maxPrice: newValue } );
    }

    return (
        <div { ...blockProps }>
            <InspectorControls>
                <PanelBody title={ __( 'Settings' ) }>
                    <NumberControl
                        label="Number of Services to Display"
                        value={ postsPerPage }
                        min="-1"
                        onChange={ onChangeServicesNumber }
                    />

                    <SelectControl
                        label="Display Order"
                        value={ displayOrder }
                        options={ [
                            { value: 'DESC', label: 'Newest' },
                            { value: 'ASC', label: 'Oldest' },
                        ] }
                        onChange={ onChangeDisplayOrder }
                    />

                    <SelectControl
                        multiple
                        label="Filter by Service Category"
                        value={ categories }
                        options={ categoriesOptions }
                        onChange={ onChangeCategories }
                    />

                    <BaseControl label="Filter by Price">
                        <HStack spacing={ 2 }>
                            <NumberControl
                                label="Minimum"
                                value={ minPrice }
                                onChange={ onChangeMinPrice }
                            />
                            <NumberControl
                                label="Maximum"
                                value={ maxPrice }
                                onChange={ onChangeMaxPrice }
                            />
                        </HStack>
                    </BaseControl>
                </PanelBody>
            </InspectorControls>

            <ServerSideRender
                block="services-carousel/services-carousel"
                attributes={ attributes }
            />
        </div>
    );
}
