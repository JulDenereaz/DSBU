<?php

namespace App\Filament\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class GenerateReadme extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'generateReadme')
            ->label('Generate Readme')
            ->icon('heroicon-o-document-text')
            ->color(function($record) {
                return 'success';
            })
            ->action(function ($record, Action $action) {
                // Format the README content with record data
                $sectionGeneral = sprintf(
                    "-----------------------------\n" .
                    "#GENERAL INFORMATION\n" .
                    "-----------------------------\n" .
                    "- Title of the research project: %s\n" .
                    "- Funding agency(ies)(UNIL,SNSF,EU,etc.) and grant number: %s\n" .
                    "- Date covered by the project: %s - %s\n" .
                    "- Name of the PI: %s\n" .
                    "- Institute: %s (%s), %s (%s)\n" .
                    "- Address: %s\n" .
                    "- ORCID: %s\n" .
                    "- Email: %s\n" .
                    "- Author of this readme: %s %s\n".
                    "\n" ,
                    $record->project->name,
                    $record->project->funding,      
                    $record->project->start_date, 
                    $record->project->end_date, 
                    $record->group->group_name, 
                    $record->group->faculty, 
                    $record->group->faculty_abb, 
                    $record->group->department, 
                    $record->group->department_abb, 
                    $record->group->address,
                    $record->group->orcid, 
                    $record->group->email, 
                    $record->user->firstname,
                    $record->user->lastname
                );

                $sectionDataCategory = sprintf(
                    "-----------------------------\n" .
                    "#DATA TYPES AND RELATED LINKS\n" .
                    "-----------------------------\n" .
                    "- Type of Data: %s, %s\n" .
                    "- Personal Data: %s\n" .
                    "- Sensitive Data: %s\n" .
                    "- Encrypted Data: %s\n" .
                    "- Storage Period: %s\n" .
                    "- License: %s\n".
                    "\n" ,
                    $record->equipment->dataCategory->category,
                    $record->dataMethod->method,
                    $record->is_personal ? "Yes" : "No",
                    $record->is_sensitive ? "Yes" : "No",
                    $record->is_encrypted ? "Yes" : "No",
                    $record->storage_period,
                    $record->license,

                );
                $sectionDataCollection = sprintf(
                    "-----------------------------\n" .
                    "#DATA COLLECTION\n" .
                    "-----------------------------\n" .
                    "- Date of Data Collection: %s\n" .
                    "- Samples (Strains ID, Treatments): %s\n" .
                    "- Protocol used for sample preparation: %s\n" .
                    "- Protocol description: %s\n" .
                    "- DOI of the protocol: %s\n" .
                    "- Short description of the experiment: %s\n".
                    "\n" ,
                    $record->collection_date,
                    $record->samples,
                    $record->protocol->protocol_name,
                    $record->protocol->description,
                    $record->protocol->doi,
                    $record->description,

                );
                
                $sectionProcessing = sprintf(
                    "-----------------------------\n" .
                    "#PROCESSING, VERSIONING AND QUALITY ASSURANCE\n" .
                    "-----------------------------\n" .
                    "- Equipment used for data collection: %s\n" .
                    "- Equipment platform or institute: %s (%s)\n" .
                    "- Equipment description: %s\n" .
                    "- Software: %s\n" .
                    "\n" ,
                    // "- File format(s): %s\n" ,
                    $record->equipment->name,
                    $record->equipment->platform->name,
                    $record->equipment->platform->shortname,
                    $record->description,
                    $record->software,
                    
                );
                
                $sectionOrganisation = sprintf(
                    "-----------------------------\n" .
                    "#DATA ORGANISATION\n" .
                    "-----------------------------\n" .
                    "- Naming system: This readme explains the data and the data structure of the folder that contains them.\n" .
                    "-*filename* correspond to:" .
                    ".." .
                    "- Folder and files structure: %s (%s)\n".
                    "\n" ,
                    // "- File format(s): %s\n" ,
                    $record->equipment->name,
                    $record->equipment->platform->name,
                    $record->equipment->platform->shortname,
                    $record->description,
                    $record->software,

                );
                $sectionFooter = sprintf(
                    "-----------------------------\n" .
                    "#Supplementary Table: %s\n" .
                    "\n" .
                    "-----------------------------\n" .
                    "#END OF README\n" .
                    "-----------------------------\n" ,
                    // "- File format(s): %s\n" ,
                    $record->supp_table ? $record->supp_table : "No",

                );

                $record->update([
                    'status' => 'CREATED',
                ]);


                $readmeContent = $sectionGeneral . $sectionDataCategory . $sectionDataCollection . $sectionProcessing . $sectionOrganisation . $sectionFooter;

                // Return the file as a download response
                return Response::streamDownload(function () use ($readmeContent) {
                    echo $readmeContent;
                }, 'readme.txt');
            })
            ->visible(fn ($record) => $record->status !== 'Incomplete');
    }
}
