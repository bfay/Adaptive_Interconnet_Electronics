<?php
class oxy_custom_control{
	
}

// Custom controls created by SDS

/******************************************************Title for General Tab*********************************************************/
class WP_Customize_GeneralBasic_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>General</h3><?php
	}
}

class WP_Customize_MainColumn_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Main Column</h3><?php
	}
}

class WP_Customize_ContentColumn_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Content Column</h3><?php
	}
}

class WP_Customize_LeftColumnHeading_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Left Column Heading</h3><?php
	}
}

class WP_Customize_LeftColumnBox_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Left Column Box</h3><?php
	}
}

class WP_Customize_RightColumnHeading_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Right Column Heading</h3><?php
	}
}

class WP_Customize_RightColumnBox_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Right Column Box</h3><?php
	}
}

class WP_Customize_CategoryBoxHeading_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Category Box Heading</h3><?php
	}
}

class WP_Customize_CategoryBoxContent_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Category Box Content</h3><?php
	}
}

class WP_Customize_FilterBoxHeading_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Filter Box Heading</h3><?php
	}
}

class WP_Customize_FilterBoxContent_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Filter Box Content</h3><?php
	}
}

/******************************************************Title for Prices Tab*********************************************************/

class WP_Customize_PricesBasic_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Prices</h3><?php
	}
}

/******************************************************Buttons Tab*********************************************************/

class WP_Customize_Buttons_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Buttons</h3><?php
	}
}

class WP_Customize_ExclusiveButtons_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Exclusive Buttons</h3><?php
	}
}

class WP_Customize_LightButtons_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Light Buttons</h3><?php
	}
}

class WP_Customize_SliderButtons_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Slider Buttons</h3><?php
	}
}

/******************************************************Header Tab*********************************************************/
class WP_Customize_Header_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Header</h3><?php
	}
}

class WP_Customize_TopBar_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Top Bar</h3><?php
	}
}

class WP_Customize_SearchBar_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Search Bar</h3><?php
	}
}

class WP_Customize_CartSection_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Cart Section</h3><?php
	}
}
/******************************************************Main Menu Bar Tab*********************************************************/

class WP_Customize_MainMenuBar_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Main Menu</h3><?php
	}
}

class WP_Customize_HomePageLink_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Main Menu Parent Links</h3><?php
	}
}

class WP_Customize_ContactSection_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Contact Section</h3><?php
	}
}

class WP_Customize_SubMenu_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Sub-Menu</h3><?php
	}
}

class WP_Customize_MobileMainMenuBar_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Mobile Main Menu Bar</h3><?php
	}
}

/******************************************************Mid Section Tab*********************************************************/
class WP_Customize_ProductBox_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Product Box</h3><?php
	}
}

class WP_Customize_ProductPageTabs_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Product Page - Tabs</h3><?php
	}
}

class WP_Customize_ProductSlideronHomePage_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Product Slider on Home Page</h3><?php
	}
}

/******************************************************Footer tab*********************************************************/
 class WP_Customize_FeatureBlock_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Feature Block</h3><?php
	}
}

class WP_Customize_AboutUsCustomColumnFollowUsContactUs_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>About Us, Custom Column, Follow Us, Contact Us</h3><?php
	}
}

class WP_Customize_InformationCustomerServiceExtrasMyAccount_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Information, Customer Service, Extras, My Account</h3><?php
	}
}

class WP_Customize_PoweredbyPaymentImages_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Powered by, Payment Images</h3><?php
	}
}

class WP_Customize_BottomCustomBlock_Control extends WP_Customize_Control {
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	public function render_content() {
		?><h3>Bottom Custom Block</h3><?php
	}
}
