# Desktop Client

The desktop client is designed to be simple to use and integrated with the SQL database for reservations / show storage. It can be run in a browser without local file storage or in an nw.js executable.

NW.js allows for full node access and DOM control inside a native application, as such it is quite useful.

# Compilation Instructions

Download NW.JS (check the repo for a zip as it is actively being developed) and simply drag the desktop/ folder into the nw.exe for a glimpse at what it should like.

For more specific instructions, nw.js provides details on how to compile based on what OS you are using.

We will include links to prepackaged executables upon hitting version 1.x.x and engaging in a professional release.

# Usage

This application will present you with a menu that can be used for house plot design and show transaction recording / ticket printing. Using node to exec, the application expects a print function (which you can configure) to exist. Currently we don't have a coverall for printers, as many theaters use different printers (whether it be thermal, digital, or not at all) however we allow you to call your own function with variable arguments using %notation to reference internal variables.

# Boxoffice Management

The different menu items allow you to create and build a show from the ground up, starting with House Plot design and ending with show transaction management. This is a critical function in the boxoffice and is delegated through separate menu options.

Currently our data management is non-functional, however the primary parts of our application exist and are ready to for use.

As this is a real product intended for real use, improvements will be made to ensure a positive experience for both users and producers.