import React, { Component, createRef } from 'react';

import './style.css';

class WPD_CustomAccordion extends Component {
  static slug = 'wca_accordian';

  constructor(props) {
    super(props);
    this.state = {
      activeIndex: 0,
      items: this.parseContent(props.content || [])
    };
    this.contentRefs = [];
  }

  parseContent = (content) => {
    return content.map((item) => {
      const attrs = item && item.props && item.props.attrs ? item.props.attrs : {};
      return {
        title: attrs.accordian_title || '',
        content: attrs.accordian_content || '',
        link: attrs.accordian_link || '',
        linkText: attrs.accordian_link_text || '',
        image: attrs.accordion_image || '',
        icon: attrs.accordion_icon || '',
        icon_image: attrs.accordion_icon_image || '',
        image_icon: attrs.image_icon || '',
      };
    });
  };

  componentDidUpdate(prevProps) {
    if (prevProps.content !== this.props.content) {
      const items = this.parseContent(this.props.content || []);
      this.setState({ items }, () => {
        this.updateContentHeights();
      });
    } else {
      this.updateContentHeights();
    }
  }
  componentDidMount() {
    this.contentRefs = this.state.items.map(() => createRef());
    
    setTimeout(() => {
      this.updateContentHeights();
    }, 0);
    
    // Add a listener for Divi's custom events
    if (window.jQuery) {
      window.jQuery(document).on('et_builder_api_ready', (event, API) => {
        this.updateContentHeights();
      });
    }
  }

  // Clean up event listeners
  componentWillUnmount() {
    if (window.jQuery) {
      window.jQuery(document).off('et_builder_api_ready');
    }
  }

  // Update the content heights
  updateContentHeights = () => {
    this.state.items.forEach((_, index) => {
      const ref = this.contentRefs[index];
      if (ref && ref.current) {
        if (this.state.activeIndex === index) {
          ref.current.style.maxHeight = `${ref.current.scrollHeight}px`;
        } else {
          ref.current.style.maxHeight = '0px';
        }
      }
    });
  };

  // Toggle accordion items
  toggleAccordion = (index) => {
		if (this.state.activeIndex === index) {
			return;
		}
		this.setState({ activeIndex: index });
	};

  render() {
    const { items, activeIndex } = this.state;
		const {
			title_color,
			title_font_size,
			icon_color,
			icon_font_size,
			content_color,
			content_font_size
		} = this.props;
    return (
			<fragment>
				{items.map((item, i) => (
					<div className="wpd_accordian_contents">
						<div
							key={`accordion-item-${i}`}
							className={`wpd-accordion-item ${activeIndex === i ? 'active' : ''}`}
						>
							<h3
								className="wpd-accordion-title"
								onClick={() => this.toggleAccordion(i)}
								style={{color:title_color, fontSize: title_font_size}}
							>
								{item.image_icon === 'on' ? <img className="wpd-accordion-image" src={item.icon_image} alt={item.title} style={{height: icon_font_size, width: icon_font_size}}/> : <span className="et-pb-icon et-pb-font-icon" dangerouslySetInnerHTML={{ __html: item.icon }} style= {{color:icon_color, fontSize: icon_font_size, height: icon_font_size, width: icon_font_size}} />
								}
								{item.title}
							</h3>
							<div
								className="wpd-accordion-description"
								ref={el => this.contentRefs[i] = { current: el }}
								style={{ 
									maxHeight: '0px',
									overflow: 'hidden', 
									transition: 'max-height 0.3s ease'
								}}
							>
								<div style= {{color:content_color, fontSize: content_font_size}} dangerouslySetInnerHTML={{ __html: item.content }} />
								
								{item.link && (
									<a 
										className="wpd-accordion-button"
										href={item.link} 
										target="_blank" 
										rel="noopener noreferrer"
									>
										{item.linkText || 'Read More'}
									</a>
								)}
							</div>
							<div className='img'>
								{item.image && (
									<img
										className="wpd-accordion-image"
										src={item.image}
										alt={item.title}
									/>
								)}
							</div>
						</div>
					</div>
				))}
			</fragment>
    );
  }
}

export default WPD_CustomAccordion;