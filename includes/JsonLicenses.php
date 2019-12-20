<?php

/**
 * JsonLicenses
 *
 * Extends the mediawiki licenses class to put the available licenses out in a json
 * format for ExtJS combobox.
 *
 * @author Sebastian Ulbricht
 */
class JsonLicenses extends Licenses {

	/**
	 *
	 * @var array
	 */
	protected $json;

	public function __construct() {
		parent::__construct( [ 'fieldname' => 'JsonLicenses' ] );
	}

	/**
	 *
	 * @return string
	 */
	public function getJsonOutput() {
		$this->json[] = $this->outputJsonOption( wfMessage( 'nolicense' )->text(), '' );
		$this->makeJson( $this->getLicenses() );
		return json_encode( [ 'items' => $this->json ] );
	}

	/**
	 *
	 * @param string $text
	 * @param string $value
	 * @param int $depth
	 * @return array
	 */
	protected function outputJsonOption( $text, $value, $depth = 0 ) {
		$msg = Message::newFromKey( 'license-header' );
		return [
			'text' => $text,
			'value' => "\n\n=={$msg->inContentLanguage()->text()}==\n{{$value}}",
			'indent' => $depth
		];
	}

	/**
	 *
	 * @param array $tagset
	 * @param int $depth
	 */
	protected function makeJson( $tagset, $depth = 0 ) {
		foreach ( $tagset as $key => $val ) {
			if ( is_array( $val ) ) {
				$this->json[] = $this->outputJsonOption( $key, '', $depth );
				$this->makeJson( $val, $depth + 1 );
			} else {
				$this->json[] = $this->outputJsonOption( $val->text, $val->template, $depth );
			}
		}
	}

}
