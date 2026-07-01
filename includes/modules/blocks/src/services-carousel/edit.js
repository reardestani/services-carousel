import { useBlockProps } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit( { attributes, setAttributes, clientId } ) {
    const blockProps = useBlockProps( {
        className: `svcl-container`
    } );

    return (
        <div { ...blockProps }>
            Services Carousel
        </div>
    );
}
