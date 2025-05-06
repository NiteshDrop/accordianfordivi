// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

class WPD_CustomAccordion extends Component {
	static slug = 'wca_accordian';

	render() {
		const contents = this.props.content;
		const items = contents.map((item, index) => {
			const attrs = item && item.props && item.props.attrs ? item.props.attrs : {};
			return {
				title: attrs.accordian_title,
				content: attrs.accordian_content,
				icon: attrs.accordion_icon,
				link: attrs.accordian_link,
				linkText: attrs.accordian_link_text,
				image: attrs.accordion_image,
			};
		});
		return (
			<div>
				{items.map((item, i) => (
					<div key={i} className="wpd_accordian_contents">
						<h3 className="wpd-accordion-title"><span className={item.icon}></span>{item.title}</h3>
						<div className="wpd-accordion-description" dangerouslySetInnerHTML={{ __html: item.content }} />
						{item.link && (
							<a href={item.link} target="_blank" rel="noopener noreferrer">
								{item.linkText}
							</a>
						)}
						{item.image && <img src={item.image} alt={item.title} />}
					</div>
				))}
			</div>
		);
	}
}

export default WPD_CustomAccordion;
