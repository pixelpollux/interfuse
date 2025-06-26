import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { useRef, useEffect } from '@wordpress/element';
import { PanelBody, SelectControl, TextControl } from '@wordpress/components';
import { useEntityRecords } from '@wordpress/core-data';
import { __ } from '@wordpress/i18n';

import Splide from '@splidejs/splide';

import './style.scss';

export default function Edit({ attributes, setAttributes }) {
	const { postType, postsToShow, itemsMobile, itemsTablet, itemsDesktop } =
		attributes;

	const blockProps = useBlockProps({
		className: 'slider-block-posts-carousel-full alignfull',
	});

	const postTypes = useSelect((select) => {
		const types = select('core').getPostTypes({
			per_page: -1,
		});

		return types?.filter(
			(type) =>
				type.slug !== 'attachment' &&
				(type.slug === 'post' ||
					(type.viewable && !type.slug.startsWith('wp_'))),
		);
	}, []);

	/* eslint-disable indent */
	const { records: posts, isResolving } = useEntityRecords(
		'postType',
		postType || 'post', // fallback to a default
		postType
			? {
					per_page: postsToShow,
					_embed: true,
				}
			: null,
	);
	/* eslint-enable indent */

	const sliderRef = useRef();

	useEffect(() => {
		if (sliderRef.current && posts?.length) {
			const splide = new Splide(sliderRef.current, {
				type: 'loop',
				perPage: itemsDesktop || 4,
				perMove: 1,
				focus: 'center',
				arrows: false,
				pagination: false,
				gap: '1rem',
				trimSpace: false,
				padding: { left: '12%', right: '12%' },
				breakpoints: {
					780: {
						perPage: itemsTablet || 3,
					},
					480: {
						perPage: itemsMobile || 1,
					},
				},
			});

			splide.mount();

			return () => splide.destroy();
		}
	}, [posts, itemsDesktop, itemsTablet, itemsMobile]);

	if (!postType) {
		return (
			<div {...blockProps}>
				<p>{__('Choose a post type to display.', 'matchbox')}</p>
			</div>
		);
	}

	if (!posts?.length) {
		return (
			<div {...blockProps}>
				<p>No posts found.</p>
			</div>
		);
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Slider Settings', 'matchbox')} initialOpen={true}>
					<TextControl
						label={__('Items (≤ 525px)', 'matchbox')}
						type="number"
						value={itemsMobile}
						onChange={(val) =>
							setAttributes({ itemsMobile: parseInt(val, 10) })
						}
					/>
					<TextControl
						label={__('Items (≤ 781px)', 'matchbox')}
						type="number"
						value={itemsTablet}
						onChange={(val) =>
							setAttributes({ itemsTablet: parseInt(val, 10) })
						}
					/>
					<TextControl
						label={__('Items (≤ 1200px)', 'matchbox')}
						type="number"
						value={itemsDesktop}
						onChange={(val) =>
							setAttributes({ itemsDesktop: parseInt(val, 10) })
						}
					/>
					<SelectControl
						label={__('Post Type', 'matchbox')}
						value={postType}
						options={
							postTypes
								? postTypes.map((type) => ({
										label: type.labels?.singular_name || type.name,
										value: type.slug,
									}))
								: [
										{
											label: __('Loading…', 'matchbox'),
											value: '',
										},
									]
						}
						onChange={(val) => setAttributes({ postType: val })}
					/>
					<TextControl
						label={__('Number of posts to show', 'matchbox')}
						type="number"
						value={postsToShow}
						onChange={(val) =>
							setAttributes({ postsToShow: parseInt(val, 10) })
						}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...blockProps}>
				<div ref={sliderRef} className="splide">
					<div className="splide__track">
						<ul className="splide__list">
							{isResolving && (
								<li className="splide__slide">{__('Loading…', 'matchbox')}</li>
							)}

							{!isResolving &&
								posts?.map((post) => {
									const title =
										post.title?.rendered || __('(no title)', 'matchbox');
									const featuredMedia =
										post._embedded?.['wp:featuredmedia']?.[0];
									const imageUrl = featuredMedia?.source_url;

									return (
										<li
											key={post.id}
											className="splide__slide wp-block-matchbox-slide"
										>
											<div className="slide-content">
												{imageUrl && (
													<div className="slide-content__image">
														<img
															src={imageUrl}
															alt={featuredMedia?.alt_text || title}
														/>
													</div>
												)}

												<p
													className="slide-content__title"
													dangerouslySetInnerHTML={{
														__html: title,
													}}
												></p>
											</div>
										</li>
									);
								})}
						</ul>
					</div>
				</div>
			</div>
		</>
	);
}
