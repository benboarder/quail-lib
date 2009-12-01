<?php

/**
 * Section 508 Guideline
 *
 * @package
 */


class Section508Guideline extends quailGuideline{

	var $tests = array(
		'imgHasAlt',
		'imgAltIsDifferent',
		'imgAltIsTooLong',
		'imgNonDecorativeHasAlt',
		'imgImportantNoSpacerAlt',
		'imgAltNotPlaceHolder',
		'imgAltNotEmptyInAnchor',
		'imgAltIsSameInText',
		'objectTextUpdatesWhenObjectChanges',
		'objectLinkToMultimediaHasTextTranscript',
		'objectMustContainText',
		'scriptInBodyMustHaveNoscript',
		'aLinksToMultiMediaRequireTranscript',
		'imgNotReferredToByColorAlone',
		'appletsDoneUseColorAlone',
		'inputDoesNotUseColorAlone',
		'objectDoesNotUseColorAlone',
		'scriptsDoNotUseColorAlone',
		'imgMapAreasHaveDuplicateLink',
		'imgWithMapHasUseMap',
		'tableDataShouldHaveTh',
		'framesHaveATitle',
		'frameTitlesDescribeFunction',
		'frameSrcIsAccessible',
		'frameRelationshipsMustBeDescribed',
		'framesetMustHaveNoFramesSection',
		'imgGifNoFlicker',
		'appletsDoNotFlicker',
		'objectDoesNotFlicker',
		'scriptsDoNotFlicker',
		'scriptInBodyMustHaveNoscript',
		'appletContainsTextEquivalentInAlt',
		'appletContainsTextEquivalent',
		'appletUIMustBeAccessible',
		'inputTextHasLabel',
		'inputImageHasAlt',
		'inputImageAltIdentifiesPurpose',
		'inputImageAltIsShort',
		'inputImageAltIsNotFileName',
		'inputImageAltIsNotPlaceholder',
		'inputTextHasValue',
		'selectHasAssociatedLabel',
		'passwordHasLabel',
		'checkboxHasLabel',
		'fileHasLabel',
		'radioHasLabel',
		'skipToContentLinkProvided',
		'documentAutoRedirectNotUsed',
		'documentMetaNotUsedWithTimeout',
	);
}