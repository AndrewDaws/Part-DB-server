---
layout: default
title: Import Bill of Material (BOM) for Projects
nav_order: 5
parent: Usage
---

# Import Bill of Material (BOM) for Projects

Part-DB supports the import of Bill of Material (BOM) files for projects. This allows you to directly import a BOM file from your ECAD software into your Part-DB project.


The import process is currently semi-automatic. This means Part-DB will take the BOM file and create entries for all parts in the BOM file in your project and assign fields like
mountnames (e.g. 'C1, C2, C3'), quantity and more. 
However, you still have to assign the parts from Part-DB database to the entries (if applicable) after the import by hand, 
as Part-DB can not know which part you had in mind when you designed your schematic.

## Usage
In the project view or edit click on the "Import BOM" button, below the BOM table. This will open a dialog where you can
select the BOM file you want to import and some options for the import process:

* **Type**: The format/type of the BOM file. See below for explanations of the different types.
* **Clear existing BOM entries before import**: If this is checked, all existing BOM entries, which are currently associated with the project, will be deleted before the import.

### Supported BOM file formats

* **KiCAD Pcbnew BOM (CSV file)**: A CSV file of the Bill of Material (BOM) generated by [KiCAD Pcbnew](https://www.kicad.org/). 
Please note that you have to export the BOM from the PCB editor, the BOM generated by the schematic editor (Eeschema) has a different format and does not work with this type.
You can generate this BOM file by going to "File" -> "Fabrication Outputs" -> "Bill of Materials" in Pcbnew and save the file to your desired location.