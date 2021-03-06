<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
    Route::get('instructions', ['uses' => 'HomeController@instructions', 'as' => 'instructions']);
    Route::get('files/get/{id}', ['uses' =>'FilesController@getFile', 'as' => 'get_file']);
    Route::get('files/open/{id}', ['uses' => 'FilesController@openFile', 'as' => 'open_file']);
    Route::get('files/{id}/delete', ['uses' => 'RecycleBinController@deleteUnlinkedFile', 'as' => 'delete_file']);
    Route::get('files', ['uses' => 'FilesController@filesList', 'as' => 'files_list']);
    Route::get('files/get-postal-codes', ['uses' => 'FilesController@getPostalCodes']);
    Route::get('files/get-world-countries', ['uses' => 'FilesController@getCountries']);
    Route::get('invoices', ['uses' => 'InvoicesController@invoices', 'as' => 'invoices']);
    Route::get('invoices/new', ['uses' => 'InvoicesController@addInvoice', 'as' => 'new_invoice']);
    Route::post('invoices/new', ['uses' =>'InvoicesController@SaveInvoice']);
    Route::get('invoices/search', ['uses' => 'InvoicesController@searchInvoice', 'as' => 'search_invoice']);
    Route::get('invoices/{id}', ['uses' => 'InvoicesController@invoiceDetails', 'as' => 'invoice_details']);
    Route::get('invoices/{id}/invoice-data', ['uses' => 'InvoicesController@invoiceData', 'as' => 'invoice_data']);
    Route::get('invoices/{id}/add-file', ['uses' => 'FilesController@addFile', 'as' => 'add_file']);
    Route::post('invoices/{id}/add-file', ['uses' => 'FilesController@saveFile']);
    Route::post('invoices/{invoiceId}/remove-file/{fileId}', ['uses' => 'FilesController@removeFile', 'as' => 'remove_file']);
    Route::get('invoices/{id}/edit', ['uses' => 'InvoicesController@editInvoiceDetails', 'as' => 'edit_invoice']);
    Route::post('invoices/{id}/to-trash', ['uses' => 'InvoicesController@deleteInvoice', 'as' => 'invoice_to_trash']);
    Route::post('invoice/{id}/delete', ['uses' => 'RecycleBinController@deleteInvoice', 'as' => 'delete_invoice']);
    Route::post('invoices/{id}/restore', ['uses' => 'RecycleBinController@restoreInvoice', 'as' => 'restore_invoice']);
    Route::post('invoices/{id}/edit', ['uses' => 'InvoicesController@updateInvoiceDetails']);
    Route::get('invoices/{id}/new-item', ['uses' => 'ItemsController@addItemToInvoice', 'as' => 'new_item']);
    Route::post('invoices/{id}/new-item', ['uses' => 'ItemsController@saveItem']);
    Route::get('items/{id}/edit', ['uses' => 'ItemsController@editItem', 'as' => 'edit_item']);
    Route::post('items/{id}/edit', ['uses' => 'ItemsController@updateItem']);
    Route::get('items', ['uses' => 'ItemsController@items', 'as' => 'items']);
    Route::get('search-items/get-items', ['uses' => 'ItemsController@searchItems', 'as' => 'item_search']);
    Route::get('categories/{id}/items', ['uses' => 'ItemsController@showCategoryItems', 'as' => 'category_items']);
    Route::get('companies', ['uses' => 'CompaniesController@companies', 'as' => 'companies']);
    Route::get('companies/foreign-companies', ['uses' => 'ForeignCompaniesController@foreignCompanies', 'as' => 'foreign_companies']);
    Route::get('companies/foreign-companies/{id}', ['uses' => 'ForeignCompaniesController@foreignCompanyDetails', 'as' => 'fc_details']);
    Route::get('companies/foreign-companies/{id}/edit', ['uses' => 'ForeignCompaniesController@editForeignCompany', 'as' => 'edit_fc']);
    Route::post('companies/foreign-companies/{id}/edit', ['uses' => 'ForeignCompaniesController@updateForeignCompany']);
    Route::post('companies/foreign-companies/new-company', ['uses' => 'ForeignCompaniesController@saveForeignCompany', 'as' => 'new_fc']);
    Route::get('companies/new', ['uses' => 'CompaniesController@addCompany', 'as' => 'new_company']);
    Route::get('companies/{id}', ['uses' => 'CompaniesController@companyDetails', 'as' => 'company_details']);
    Route::get('companies/{id}/new-invoice', ['uses' => 'CompaniesController@addCompanyInvoice', 'as' => 'new_company_invoice']);
    Route::post('companies/{id}/new-invoice', ['uses' => 'CompaniesController@saveCompanyInvoice']);
    Route::post('companies/new', ['uses' => 'CompaniesController@saveCompany']);
    Route::get('companies/{id}/edit', ['uses' => 'CompaniesController@editCompanyDetails', 'as' => 'edit_company']);
    Route::post('companies/{id}/edit', ['uses' => 'CompaniesController@updateCompanyDetails']);
    Route::get('dashboard', ['uses' => 'DashboardController@dashboard', 'as' => 'dashboard']);
    Route::get('dashboard/deleted-items', ['uses' => 'RecycleBinController@overview', 'as' => 'deleted_items']);
    Route::post('categories/new', ['uses' => 'DashboardController@saveCategory', 'as' => 'new_category']);
    Route::post('pay-instruments/new', ['uses' => 'DashboardController@savePayInstrument', 'as' => 'new_instrument']);
    Route::post('packing-unit/new', ['uses' => 'DashboardController@savePackingUnit', 'as' => 'packing_unit']);
    Route::post('attachment-type/new', ['uses' => 'DashboardController@saveAttachment', 'as' => 'attachment_type']);
});
