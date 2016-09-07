<?php

class MSW_Mailchimp_Error extends Exception {}
class MSW_Mailchimp_HttpError extends MSW_Mailchimp_Error {}

/**
 * The parameters passed to the API call are invalid or not provided when required
 */
class MSW_Mailchimp_ValidationError extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_ServerError_MethodUnknown extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_ServerError_InvalidParameters extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Unknown_Exception extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Request_TimedOut extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Zend_Uri_Exception extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_PDOException extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Avesta_Db_Exception extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_XML_RPC2_Exception extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_XML_RPC2_FaultException extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Too_Many_Connections extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Parse_Exception extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_Unknown extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_Disabled extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_DoesNotExist extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_NotApproved extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_ApiKey extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_UnderMaintenance extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_AppKey extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_IP extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_DoesExist extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_InvalidRole extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_InvalidAction extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_MissingEmail extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_CannotSendCampaign extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_MissingModuleOutbox extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_ModuleAlreadyPurchased extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_ModuleNotPurchased extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_User_NotEnoughCredit extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_MC_InvalidPayment extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_DoesNotExist extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_InvalidInterestFieldType extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_InvalidOption extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_InvalidUnsubMember extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_InvalidBounceMember extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_AlreadySubscribed extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_NotSubscribed extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_InvalidImport extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_MC_PastedList_Duplicate extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_MC_PastedList_InvalidImport extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Email_AlreadySubscribed extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Email_AlreadyUnsubscribed extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Email_NotExists extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Email_NotSubscribed extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_MergeFieldRequired extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_CannotRemoveEmailMerge extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_Merge_InvalidMergeID extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_TooManyMergeFields extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_InvalidMergeField extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_InvalidInterestGroup extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_List_TooManyInterestGroups extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_DoesNotExist extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_StatsNotAvailable extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_InvalidAbsplit extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_InvalidContent extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_InvalidOption extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_InvalidStatus extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_NotSaved extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_InvalidSegment extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_InvalidRss extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_InvalidAuto extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_MC_ContentImport_InvalidArchive extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_BounceMissing extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Campaign_InvalidTemplate extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_EcommOrder extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Absplit_UnknownError extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Absplit_UnknownSplitTest extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Absplit_UnknownTestType extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Absplit_UnknownWaitUnit extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Absplit_UnknownWinnerType extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Absplit_WinnerNotSelected extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_Analytics extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_DateTime extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_Email extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_SendType extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_Template extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_TrackingOptions extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_Options extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_Folder extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_URL extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Module_Unknown extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_MonthlyPlan_Unknown extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Order_TypeUnknown extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_PagingLimit extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Invalid_PagingStart extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Max_Size_Reached extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_MC_SearchException extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Goal_SaveFailed extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Conversation_DoesNotExist extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Conversation_ReplySaveFailed extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_File_Not_Found_Exception extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Folder_Not_Found_Exception extends MSW_Mailchimp_Error {}

/**
 * None
 */
class MSW_Mailchimp_Folder_Exists_Exception extends MSW_Mailchimp_Error {}


