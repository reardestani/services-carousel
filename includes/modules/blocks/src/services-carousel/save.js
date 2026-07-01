import { useBlockProps } from '@wordpress/block-editor';

export default function save( { attributes } ) {

    const blockProps = useBlockProps.save( {
        className: `svcl-container`
    } );

    return (
        <div { ...blockProps }>
            Services Carousel
        </div>
    );
}
