<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Translate
 * @subpackage Ressource
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Zend_Validate.php 1075 2010-10-20 15:29:38Z m.sterczynski $
 */

/**
 * EN-Revision: 22075
 */


            return array(
            "sample" => "sample in pl",
            // Zend_Validate_Alnum
            "Invalid type given, value should be float, string, or integer" => "Invalid type given, value should be float, string, or integer",
            "'%value%' contains characters which are non alphabetic and no digits" => "'%value%' contains characters which are non alphabetic and no digits",
            "'%value%' is an empty string" => "'%value%' is an empty string",

            // Zend_Validate_Alpha
            "Invalid type given, value should be a string" => "Invalid type given, value should be a string",
            "'%value%' contains non alphabetic characters" => "'%value%' contains non alphabetic characters",
            "'%value%' is an empty string" => "'%value%' is an empty string",

            // Zend_Validate_Barcode
            "'%value%' failed checksum validation" => "'%value%' failed checksum validation",
            "'%value%' contains invalid characters" => "'%value%' contains invalid characters",
            "'%value%' should have a length of %length% characters" => "'%value%' should have a length of %length% characters",
            "Invalid type given, value should be string" => "Invalid type given, value should be string",

            // Zend_Validate_Between
            "'%value%' is not between '%min%' and '%max%', inclusively" => "'%value%' is not between '%min%' and '%max%', inclusively",
            "'%value%' is not strictly between '%min%' and '%max%'" => "'%value%' is not strictly between '%min%' and '%max%'",

            // Zend_Validate_Callback
            "'%value%' is not valid" => "'%value%' is not valid",
            "Failure within the callback, exception returned" => "Failure within the callback, exception returned",

            // Zend_Validate_Ccnum
            "'%value%' must contain between 13 and 19 digits" => "'%value%' must contain between 13 and 19 digits",
            "Luhn algorithm (mod-10 checksum) failed on '%value%'" => "Luhn algorithm (mod-10 checksum) failed on '%value%'",

            // Zend_Validate_CreditCard
            "Luhn algorithm (mod-10 checksum) failed on '%value%'" => "Luhn algorithm (mod-10 checksum) failed on '%value%'",
            "'%value%' must contain only digits" => "'%value%' must contain only digits",
            "Invalid type given, value should be a string" => "Invalid type given, value should be a string",
            "'%value%' contains an invalid amount of digits" => "'%value%' contains an invalid amount of digits",
            "'%value%' is not from an allowed institute" => "'%value%' is not from an allowed institute",
            "Validation of '%value%' has been failed by the service" => "Validation of '%value%' has been failed by the service",
            "The service returned a failure while validating '%value%'" => "The service returned a failure while validating '%value%'",

            // Zend_Validate_Date
            "Invalid type given, value should be string, integer, array or Zend_Date" => "Invalid type given, value should be string, integer, array or Zend_Date",
            "'%value%' does not appear to be a valid date" => "'%value%' does not appear to be a valid date",
            "'%value%' does not fit the date format '%format%'" => "'%value%' does not fit the date format '%format%'",

            // Zend_Validate_Db_Abstract
            "No record matching %value% was found" => "No record matching %value% was found",
            "A record matching %value% was found" => "A record matching %value% was found",

            // Zend_Validate_Digits
            "Invalid type given, value should be string, integer or float" => "Invalid type given, value should be string, integer or float",
            "'%value%' contains characters which are not digits; but only digits are allowed" => "'%value%' contains characters which are not digits; but only digits are allowed",
            "'%value%' is an empty string" => "'%value%' is an empty string",

            // Zend_Validate_EmailAddress
            "Invalid type given, value should be a string" => "Invalid type given, value should be a string",
            "'%value%' is no valid email address in the basic format local-part@hostname" => "'%value%' is no valid email address in the basic format local-part@hostname",
            "'%hostname%' is no valid hostname for email address '%value%'" => "'%hostname%' is no valid hostname for email address '%value%'",
            "'%hostname%' does not appear to have a valid MX record for the email address '%value%'" => "'%hostname%' does not appear to have a valid MX record for the email address '%value%'",
            "'%hostname%' is not in a routable network segment. The email address '%value%' should not be resolved from public network." => "'%hostname%' is not in a routable network segment. The email address '%value%' should not be resolved from public network.",
            "'%localPart%' can not be matched against dot-atom format" => "'%localPart%' can not be matched against dot-atom format",
            "'%localPart%' can not be matched against quoted-string format" => "'%localPart%' can not be matched against quoted-string format",
            "'%localPart%' is no valid local part for email address '%value%'" => "'%localPart%' is no valid local part for email address '%value%'",
            "'%value%' exceeds the allowed length" => "'%value%' exceeds the allowed length",

            // Zend_Validate_File_Count
            "Too many files, maximum '%max%' are allowed but '%count%' are given" => "Too many files, maximum '%max%' are allowed but '%count%' are given",
            "Too few files, minimum '%min%' are expected but '%count%' are given" => "Too few files, minimum '%min%' are expected but '%count%' are given",

            // Zend_Validate_File_Crc32
            "File '%value%' does not match the given crc32 hashes" => "File '%value%' does not match the given crc32 hashes",
            "A crc32 hash could not be evaluated for the given file" => "A crc32 hash could not be evaluated for the given file",
            "File '%value%' could not be found" => "File '%value%' could not be found",

            // Zend_Validate_File_ExcludeExtension
            "File '%value%' has a false extension" => "File '%value%' has a false extension",
            "File '%value%' could not be found" => "File '%value%' could not be found",

            // Zend_Validate_File_ExcludeMimeType
            "File '%value%' has a false mimetype of '%type%'" => "File '%value%' has a false mimetype of '%type%'",
            "The mimetype of file '%value%' could not be detected" => "The mimetype of file '%value%' could not be detected",
            "File '%value%' can not be read" => "File '%value%' can not be read",

            // Zend_Validate_File_Exists
            "File '%value%' does not exist" => "File '%value%' does not exist",

            // Zend_Validate_File_Extension
            "File '%value%' has a false extension" => "File '%value%' has a false extension",
            "File '%value%' could not be found" => "File '%value%' could not be found",

            // Zend_Validate_File_FilesSize
            "All files in sum should have a maximum size of '%max%' but '%size%' were detected" => "All files in sum should have a maximum size of '%max%' but '%size%' were detected",
            "All files in sum should have a minimum size of '%min%' but '%size%' were detected" => "All files in sum should have a minimum size of '%min%' but '%size%' were detected",
            "One or more files can not be read" => "One or more files can not be read",

            // Zend_Validate_File_Hash
            "File '%value%' does not match the given hashes" => "File '%value%' does not match the given hashes",
            "A hash could not be evaluated for the given file" => "A hash could not be evaluated for the given file",
            "File '%value%' could not be found" => "File '%value%' could not be found",

            // Zend_Validate_File_ImageSize
            "Maximum allowed width for image '%value%' should be '%maxwidth%' but '%width%' detected" => "Maximum allowed width for image '%value%' should be '%maxwidth%' but '%width%' detected",
            "Minimum expected width for image '%value%' should be '%minwidth%' but '%width%' detected" => "Minimum expected width for image '%value%' should be '%minwidth%' but '%width%' detected",
            "Maximum allowed height for image '%value%' should be '%maxheight%' but '%height%' detected" => "Maximum allowed height for image '%value%' should be '%maxheight%' but '%height%' detected",
            "Minimum expected height for image '%value%' should be '%minheight%' but '%height%' detected" => "Minimum expected height for image '%value%' should be '%minheight%' but '%height%' detected",
            "The size of image '%value%' could not be detected" => "The size of image '%value%' could not be detected",
            "File '%value%' can not be read" => "File '%value%' can not be read",

            // Zend_Validate_File_IsCompressed
            "File '%value%' is not compressed, '%type%' detected" => "File '%value%' is not compressed, '%type%' detected",
            "The mimetype of file '%value%' could not be detected" => "The mimetype of file '%value%' could not be detected",
            "File '%value%' can not be read" => "File '%value%' can not be read",

            // Zend_Validate_File_IsImage
            "File '%value%' is no image, '%type%' detected" => "File '%value%' is no image, '%type%' detected",
            "The mimetype of file '%value%' could not be detected" => "The mimetype of file '%value%' could not be detected",
            "File '%value%' can not be read" => "File '%value%' can not be read",

            // Zend_Validate_File_Md5
            "File '%value%' does not match the given md5 hashes" => "File '%value%' does not match the given md5 hashes",
            "A md5 hash could not be evaluated for the given file" => "A md5 hash could not be evaluated for the given file",
            "File '%value%' could not be found" => "File '%value%' could not be found",

            // Zend_Validate_File_MimeType
            "File '%value%' has a false mimetype of '%type%'" => "File '%value%' has a false mimetype of '%type%'",
            "The mimetype of file '%value%' could not be detected" => "The mimetype of file '%value%' could not be detected",
            "File '%value%' can not be read" => "File '%value%' can not be read",

            // Zend_Validate_File_NotExists
            "File '%value%' exists" => "File '%value%' exists",

            // Zend_Validate_File_Sha1
            "File '%value%' does not match the given sha1 hashes" => "File '%value%' does not match the given sha1 hashes",
            "A sha1 hash could not be evaluated for the given file" => "A sha1 hash could not be evaluated for the given file",
            "File '%value%' could not be found" => "File '%value%' could not be found",

            // Zend_Validate_File_Size
            "Maximum allowed size for file '%value%' is '%max%' but '%size%' detected" => "Maximum allowed size for file '%value%' is '%max%' but '%size%' detected",
            "Minimum expected size for file '%value%' is '%min%' but '%size%' detected" => "Minimum expected size for file '%value%' is '%min%' but '%size%' detected",
            "File '%value%' could not be found" => "File '%value%' could not be found",

            // Zend_Validate_File_Upload
            "File '%value%' exceeds the defined ini size" => "File '%value%' exceeds the defined ini size",
            "File '%value%' exceeds the defined form size" => "File '%value%' exceeds the defined form size",
            "File '%value%' was only partially uploaded" => "File '%value%' was only partially uploaded",
            "File '%value%' was not uploaded" => "File '%value%' was not uploaded",
            "No temporary directory was found for file '%value%'" => "No temporary directory was found for file '%value%'",
            "File '%value%' can't be written" => "File '%value%' can't be written",
            "A PHP extension returned an error while uploading the file '%value%'" => "A PHP extension returned an error while uploading the file '%value%'",
            "File '%value%' was illegally uploaded. This could be a possible attack" => "File '%value%' was illegally uploaded. This could be a possible attack",
            "File '%value%' was not found" => "File '%value%' was not found",
            "Unknown error while uploading file '%value%'" => "Unknown error while uploading file '%value%'",

            // Zend_Validate_File_WordCount
            "Too much words, maximum '%max%' are allowed but '%count%' were counted" => "Too much words, maximum '%max%' are allowed but '%count%' were counted",
            "Too less words, minimum '%min%' are expected but '%count%' were counted" => "Too less words, minimum '%min%' are expected but '%count%' were counted",
            "File '%value%' could not be found" => "File '%value%' could not be found",

            // Zend_Validate_Float
            "Invalid type given, value should be float, string, or integer" => "Invalid type given, value should be float, string, or integer",
            "'%value%' does not appear to be a float" => "'%value%' does not appear to be a float",

            // Zend_Validate_GreaterThan
            "'%value%' is not greater than '%min%'" => "'%value%' is not greater than '%min%'",

            // Zend_Validate_Hex
            "Invalid type given, value should be a string" => "Invalid type given, value should be a string",
            "'%value%' has not only hexadecimal digit characters" => "'%value%' has not only hexadecimal digit characters",

            // Zend_Validate_Hostname
            "Invalid type given, value should be a string" => "Invalid type given, value should be a string",
            "'%value%' appears to be an IP address, but IP addresses are not allowed" => "'%value%' appears to be an IP address, but IP addresses are not allowed",
            "'%value%' appears to be a DNS hostname but cannot match TLD against known list" => "'%value%' appears to be a DNS hostname but cannot match TLD against known list",
            "'%value%' appears to be a DNS hostname but contains a dash in an invalid position" => "'%value%' appears to be a DNS hostname but contains a dash in an invalid position",
            "'%value%' appears to be a DNS hostname but cannot match against hostname schema for TLD '%tld%'" => "'%value%' appears to be a DNS hostname but cannot match against hostname schema for TLD '%tld%'",
            "'%value%' appears to be a DNS hostname but cannot extract TLD part" => "'%value%' appears to be a DNS hostname but cannot extract TLD part",
            "'%value%' does not match the expected structure for a DNS hostname" => "'%value%' does not match the expected structure for a DNS hostname",
            "'%value%' does not appear to be a valid local network name" => "'%value%' does not appear to be a valid local network name",
            "'%value%' appears to be a local network name but local network names are not allowed" => "'%value%' appears to be a local network name but local network names are not allowed",
            "'%value%' appears to be a DNS hostname but the given punycode notation cannot be decoded" => "'%value%' appears to be a DNS hostname but the given punycode notation cannot be decoded",

            // Zend_Validate_Iban
            "Unknown country within the IBAN '%value%'" => "Unknown country within the IBAN '%value%'",
            "'%value%' has a false IBAN format" => "'%value%' has a false IBAN format",
            "'%value%' has failed the IBAN check" => "'%value%' has failed the IBAN check",

            // Zend_Validate_Identical
            "The two given tokens do not match" => "The two given tokens do not match",
            "No token was provided to match against" => "No token was provided to match against",

            // Zend_Validate_InArray
            "'%value%' was not found in the haystack" => "'%value%' was not found in the haystack",

            // Zend_Validate_Int
            "Invalid type given, value should be string or integer" => "Invalid type given, value should be string or integer",
             "'%value%' does not appear to be an integer" => "'%value%' does not appear to be an asdf",

            // Zend_Validate_Ip
            "Invalid type given, value should be a string" => "Invalid type given, value should be a string",
            "'%value%' does not appear to be a valid IP address" => "'%value%' does not appear to be a valid IP address",

            // Zend_Validate_Isbn
            "Invalid type given, value should be string or integer" => "Invalid type given, value should be string or integer",
            "'%value%' is no valid ISBN number" => "'%value%' is no valid ISBN number",

            // Zend_Validate_LessThan
            "'%value%' is not less than '%max%'" => "'%value%' is not less than '%max%'",

            // Zend_Validate_NotEmpty
            "Invalid type given, value should be float, string, array, boolean or integer" => "Invalid type given, value should be float, string, array, boolean or integer",
            "Value is required and can't be empty" => "Wypełnij pole",

            // Zend_Validate_PostCode
            "Invalid type given. The value should be a string or a integer" => "Invalid type given. The value should be a string or a integer",
            "'%value%' does not appear to be a postal code" => "'%value%' does not appear to be a postal code",

            // Zend_Validate_Regex
            "Invalid type given, value should be string, integer or float" => "Invalid type given, value should be string, integer or float",
            "'%value%' does not match against pattern '%pattern%'" => "Niepoprawny format",
            "There was an internal error while using the pattern '%pattern%'" => "There was an internal error while using the pattern '%pattern%'",

            // Zend_Validate_Sitemap_Changefreq
            "'%value%' is no valid sitemap changefreq" => "'%value%' is no valid sitemap changefreq",
            "Invalid type given, the value should be a string" => "Invalid type given, the value should be a string",

            // Zend_Validate_Sitemap_Lastmod
            "'%value%' is no valid sitemap lastmod" => "'%value%' is no valid sitemap lastmod",
            "Invalid type given, the value should be a string" => "Invalid type given, the value should be a string",

            // Zend_Validate_Sitemap_Loc
            "'%value%' is no valid sitemap location" => "'%value%' is no valid sitemap location",
            "Invalid type given, the value should be a string" => "Invalid type given, the value should be a string",

            // Zend_Validate_Sitemap_Priority
            "'%value%' is no valid sitemap priority" => "'%value%' is no valid sitemap priority",
            "Invalid type given, the value should be a integer, a float or a numeric string" => "Invalid type given, the value should be a integer, a float or a numeric string",

            // Zend_Validate_StringLength
            "Invalid type given, value should be a string" => "Invalid type given, value should be a string",
            "'%value%' is less than %min% characters long" => "Wpisz minimalnie %min% znaków",
            "'%value%' is more than %max% characters long" => "Wpisz maksymalnie  %max% znaków",

            // Base_Validate_Regon
            "'%value%' must contain either 7, 9 or 14 digits" => "'%value%' musi zawierać 7, 9 lub 14 cyfr",
            "Luhn algorithm (mod-11 checksum) failed on '%value%'" => "Wartość '%value%' nie jest poprawnym numerem REGON",
    
            // Base_Validate_Pesel
            "'%value%' must contain 11 digits" => "Niepoprawny format",
            "Luhn algorithm (mod-10 checksum) failed on '%value%'" => "Niepoprawny format",
	
            // Base_Validate_Nip
            "'%value%' must contain 10 digits" => "Niepoprawny format",
            "Luhn algorithm (mod-11 checksum) failed on '%value%'" => "Niepopprawny format",

            // Base_Validate_Encoding
            "Value contains inappropriate signs" => "Pole zawiera nieprawidłowe znaki",

    // _layouts
    "OPEN FINANCE - CALL CENTER - Login" => "OPEN FINANCE - CALL CENTER - Login",
    "Logged in as" => "Zalogowany jako",
    "Log out" => "Wyloguj",
    "Send" => "Wyślij",
    "Ideas? Issues? Let us know!" => "Masz pomysł? Problem? Napisz do nas!",
    "All rights reserved" => "Wszystkie prawa zastrzeżone.",
    "Error message" => "Komunikat błędu",
    "Login" => "Login",

    // agreement
    "Agreements" => "Zgody",
    "Are you sure you want to delete selected agreement?" => "Czy jesteś pewnien, że chcesz usunąć wybraną zgodę?",
    //"Add new agreement" => "Dodaj nową zgodę",
    "Update agreement" => "Edytuj zgodę",
    "Agreement was successfuly saved." => "Nowa zgoda została dodana.",
    "Agreement" => "Zgoda",
    "Agreement was successfully removed." => "Zgoda została usunięta.",
    "Agreement was successfully edited." => "Zmiany zostały zapisane.",

        // form
        "Title:" => "Tytuł",
        "Content:" => "Treść:",


    // auth
    "Error while logging in. Specified account doesnt exist or account is inactive. " => "Problem z zalogowaniem. Brak takiego konta w systemie lub konto jest nieaktywne.",
    "Error while logging in." => "Problem z zalogowaniem.",


    // ETYKIETY FORMULARZY
    
    //"First name" => "Imię",
    //"Middle name" => "Drugie imię",
    //"Surname" => "Nazwisko",
    //"Telephone" => "Telefon",
    //"Cell phone" => "Telefon komórkowy",
    //"E-mail" => "E-mail",
    //"Address" => "Adres",
    //"Street" => "Ulica",
    //"House number" => "Numer budynku",
    //"Apartment number" => "Numer mieszkania",
    //"Province" => "Województwo",
    //"City" => "Miejscowość",
    //"Nationality" => "Obywatelstwo",
    //"Last successful event date" => "Data ostatniego kontaktu",
    //"Last unsuccessful event date" => "Data ostatniej nieudanej próby kontaktu",
    //"Unsuccessful events number" => "Ilość nieudanych prób kontaktu",
    //"Customer adviser" => "Opiekun klienta",
    //"Street prefix" => "Prefix adresu",
    "Company phone" => "Telefon firmy",
    "Sex" => "Płeć",
    //"Zip code" => "Kod pocztowy",
    //"Contacts file" => "Plik z kontaktami",
    "Import title" => "Tytuł importu",
    "Template type" => "Typ szablonu",
    "Template title" => "Tytuł szablonu",
    "Tags" => "Tagi",
    "Male template content" => "Treść szablonu męska",
    "Female template content" => "Treść szablonu żeńska",
    
    // branch
    //"Add new branch" => "Dodawanie nowego oddziału",
    //"Update branches group" => "Aktualizacja grupy oddziałów",
    //"Update branch" => "Aktualizacja oddziału",
    //"New branch" => "Nowy oddział",
    "List branches groups" => "Lista grup oddziałów",
    "Branch" => "Oddział",
    //"Back to branch groups list" => "Powrót - Lista grup oddziałów",
    //"Back to branches list" => "Powrót - Lista oddziałów",
    "Branch group details" => "Szczegóły grupy oddziałów",
    //"Assigned branches" => "Lista podpiętych oddziałów",
    //"No assigned branches!" => "Brak podpiętych oddziałów!",
    "Branch Name" => "Nazwa oddziału",
    "Street" => "Ulica",

        // form
        "Name" => "Nazwa",
        "Branch status" => "Status oddziału",
        "Manager" => "Manager",
        "Branch type" => "Typ oddziału",
        "Branch groups" => "Grupy oddziałów",
        "Parking spots" => "Miejsca parkingowe",
        //"Map" => "Mapka dojazdu",


    // controller
    //"Branch was successfully deleted." => "Pomyślnie usunięto oddział.",

    // client
    "Tools" => "Narzędzia",
    "current contacts" => "bieżące kontakty",
    "Filters" => "Filtry",
    "Details" => "Szczegóły",
    "Polls" => "Ankiety",
    "Complaints" => "Reklamacje",
    "History" => "Historia",
    "Contacts history" => "Historia kontaktów",
    "Products" => "Produkty",
    "Tax residency country" => "Kraj rezydencji podatkowej",

    // common buttons
    "Add" => "Dodaj",
    "Cancel" => "Anuluj",
    "More" => "Więcej",
    "Edit" => "Edytuj",
    "Back to list" => "Powrót do listy",
    "Back" => "Powrót",
    "Show" => "Pokaż",
    "Remove" => "Usuń",
    "Save" => "Zapisz",

    // common
    "Page filter" => "Filtr strony",
    "Actions" => "Akcje",
    "Generate" => "Generuj",
    "Generate short" => "Generate krótki",
    "Generate long" => "Generuj długi",
    "Decode" => "Dekoduj",
    "Login again" => "Zaloguj ponownie",
    "No." => "Lp.",
    "Publish" => "Publikuj",
    "Hide" => "Ukryj",
    "Share" => "Udostępnij",
    "Restore" => "Przywróć",
    "none" => "brak",
    "No" => "Nie",
    "Yes" => "Tak",
    "Content" => "Treść",
    "Active" => "Aktywne",
    "Description" => "Opis",
    "Description:" => "Opis:",
    //"Submit" => "Wyślij",
    "Password:" => "Hasło:",
    "Login:" => "Login:",
    "Search" => "Szukaj",
    //"Go" => "Pokaż",

    // company
    //"New company" => "Nowa firma",
    "Company" => "Firma",
    "Company contacts" => "Kontakty firmy",
    "New company was successfully added." => "Pomyślnie dodano firmę.",
    "Company was edited successfully." => "Pomyślnie edytowano firmę.",
    "Contact data was successfully added to selected contact." => "Pomyślnie dodano dane kontaktowe do kontaktu.",
    "Contact data was successfully removed." => "Usunięto dane kontaktowe kontaktu.",
    "Contacts address was successfully added." => "Dodano adres do kontaktu.",
    "Additional contact address was successfully removed." => "Usunięto dodatkowy adres kontaktu.",

        // form
        "Company name:" => "Nazwa firmy:",
        "Search at address data:" => "Wyszukiwanie po danych adresowych:",
        "Company:" => "Firma:",
        "Assign" => "Przypisz",


    // complaints
    "Are you sure you want to delete selected complaint?" => "Czy jesteś pewien, że chcesz usunąć wybraną reklamację?",
    "Add new complaint" => "Dodaj reklamację",
    "Add complaint" => "Dodaj reklamację",
    "Update complain" => "Edycja reklamacji",
    "Complaint was successfuly edited." => "Zmiany w reklamacji zostały pomyślnie zapisane.",
    "Status" => "Status",
    "Type" => "Typ",
    "Complaint was successfuly saved." => "Reklamacja została zapisana.",
    "Complaint was successfuly removed." => "Reklamacja została usunięta.",
    "Complaints changes history" => "Historia zmian w reklamacji",
    "Back to complaints details" => "Powrót do opisu reklamacji",
    "Are you sure you want to delete selected row?" => "Czy na pewno chcesz usunąć wybrany wpis?",
    "Back to complaint details" => "Powrót do szczegółów reklamacji",

    "Application type" => "Rodzaj zgłoszenia",
    "Assign to branch" => "Dotyczy oddziału",
    "Assign to employee" => "Dotyczy pracownika",
    "Complaint type" => "Typ reklamacji",
    "Complaint status" => "Status reklamacji",
    "Assign to client" => "Dotyczy kontaktu",
    "Complaint title" => "Tytuł reklamacji",
    "Complaint title (if not on list)" => "Tytuł reklamacji (jeśli brak na liście)",
    "Responsible adviser" => "Opiekun relamacji",
    "Contact phone number" => "Telefon kontaktowy",
    "Contact e-mail" => "E-mail do kontaktu",
    "Complaint description" => "Treść reklamacji",
    "The proposed way to solve the problem" => "Zaproponowany sposób rozwiązania problemu",
    "Is there a settlement" => "Czy doszło do ugody",
    "Commentary on the complaint" => "Komentarz do reklamacji",
    "Complaints guardian" => "Opiekun reklamacji",

    // contact
    "Contact search" => "Wyszukiwanie kontaktu",
    "New contact was added successfully." => "Pomyślnie dodano kontakt.",
    "Contact was successfully edited." => "Pomyślnie edytowano kontakt.",
    "Contact data was succesfully added to selected contact." => "Pomyślnie dodano dane kontaktowe do kontaktu.",
    "Contact data was successfully removed from selected contact." => "Pomyślnie usunięto dane kontaktowe kontaktu.",
    "Address was successfully added to selected contact." => "Pomyślnie dodano adres do kontaktu.",
    "Contact was successfully assigned to company." => "Pomyślnie przypisano kontakt do firmy.",
    "Value was edited successfully." => "Pomyślnie edytowano wartość.",
    "There was error while editing selected value." => "Wystąpił błąd przy edycji wartości.",
    "Wrong data filled in edited field." => "Błędnie wypełnione pole.",
    "Value was successfully edited." => "Pomyślnie edytowano wartość",
    "Error occurred while editing selected value." => "Wystąpił błąd przy edycji wartości.",
    "Field filled incorrectly." => "Błędnie wypełnione pole.",
    "Additional contact address was successfully removed." => "Pomyślnie usunięto dodatkowy adres kontaktu.",
    "Add user to meeting" => "Dodaj do spotkania",
    "Email reminder" => "Przypomnienie E-mail",
    "SMS reminder" => "Przypomnienie SMS",

        // form
        "Telephone:" => "Telefon:",
        "Type:" => "Typ:",
        "Data:" => "Dane:",
        "Tag:" => "Tag:",
        "Middle name:" => "Drugie imię:",
        "Self contacts:" => "Kontakty własne:",
        "Branch contacts:" => "Kontakty oddziałowe:",
        "All contacts:" => "Kontakty wszystkie:",
        "Search at personal criteria:" => "Wyszukiwanie po kryteriach personalnych:",
        

    // contact mailer

        // form
        "E-mail template" => "Szablon e-maila",
        "E-mail title" => "Tytuł maila",
        "E-mail content" => "Treść maila",


    // error
    "Warning" => "Uwaga",
    "Below field should be visible only for testers. If you can see field below permission error occured." => "Poniższe pole powinno być dostępne tylko dla testerów. Jeśli widzisz poniższe pole nastąpił błąd w uprawnieniach.",
    "Testers" => "Testerzy",
    "Please send content of below field with full description of your steps to programmers." => "Proszę przesłać treść pola poniżej wraz z opisem czynności programistom.",

    "There is an error in aplications url address!" => "Błąd w adresie akcji!",
    "Action is unavailable. There was error while trying to find the right view. Page you are trying to visit is propably not available any more." => "Akcja niedostępna. Zaistaniał problem z odnalezieniem odpowiedniego widoku. Możliwe, że link, który próbujesz obejrzeć przetał być dostępny.",
    "Permissions error!" => "Błąd uprawnień!",
    "You are not authorized to execute the desired action." => "Nie masz uprawnień do wykonania żądanej akcji.",
    "Unrecognized aplication error." => "Nierozpoznany błąd apilkacji.",
    "Report the situation to the developers with precise description of activities carried out prior to stepping on this problem!" => "Zgłoś sytuację programistom w raz z dokładnym opisem czynności wykonywanych przed natrafieniem na ten problem!",

    // event
    "Event was successfully added." => "Pomyślnie dodano zdarzenie.",
    "Event was successfully edited." => "Pomyślnie edytowano zdarzenie.",

        // form
        "Comment:" => "Komentarz:",
        "Event type:" => "Typ zdarzenia:",
        "Interest point:" => "Punkt zainteresowania:",


    // feedback
    //"Add new feedback" => "Dodaj nowe zgłoszenie",
    //"If you have questions or you noticed bugs plese contact us" => "Masz pytanie? Masz jakiś problem? Zauważyłeś błąd? Napisz do nas",
    "Feedback content" => "Treść zapytania",

    "Submitted feedback was successfully saved." => "Pomyślnie zapisano przesłane zgłoszenie.",
    "Feedback was successfully removed." => "Pomyślnie usunięto zgłoszenie.",
    "Feedback was successfully edited." => "Pomyślnie edytowano zgłoszenie.",

        // form
        "Feedback content:" => "Treść zgłoszenia:",


    // Filter
    "Filter was successfully added." => "Pomyślnie dodano filtr.",
    "Filter was successfully removed." => "Pomyślnie usunięto filtr.",
    "Filter was successfully published." => "Pomyślnie opublikowano filtr.",
    "Filter was successfully hidden." => "Pomyślnie ukryto filtr.",
    "Successfully edited roles having access to the filter." => "Pomyślnie edytowano role mające dostęp do filtru.",

        // form
        "Public?" => "Publiczny?",

    // Institution
    "Add new institution" => "Dodaj nową instytucję",
    "Name" => "Nazwa",
    "Name:" => "Nazwa:",
    "New institution was successfuly saved." => "Nowa instytucja została dodana.",
    "Institution was successfully edited." => "Zmiany w danych instytucji zostały poprawnie zapisane.",
    "Are you sure you want to delete selected institution?" => "Czy jesteś pewnien, że chcesz usunąć wybraną instytucję?",
    "Institution was successfully removed." => "Instytucja została usunięta.",
    "Institution" => "Instytucja",
    "Institution:" => "Instytucja:",


    // InstitutionBranch
    "Are you sure you want to delete selected institution branch?" => "Czy jesteś pewien, że chcesz usunąć oddział w tej instytucji?",
    "Institution branch" => "Oddział instytucji",
    "Institution branch was successfully edited." => "Zmiany w oddziale instytucji zostały zapisane.",
    "Institution branch was successfully removed." => "Oddział instytucji został usunięty.",
    "New institution branch was successfuly saved." => "Nowy oddział został dodany do instytucji.",
    //"Add new institution branch" => "Dodaj oddział do instytucji",

        // form
        "Branch name:" => "Nazwa oddziału:",


    // Log

        // complaint
        "Message" => "Wykonana akcja",
        "IP" => "Adres IP komputera edytującego",
        "Employee" => "Pracownik",

    //"Logs - Users" => "Logi - Użytkownicy",
    //"Logs - Complaints" => "Logi - Reklamacje",
    //"Logs - Contacts" => "Logi - Kontakty",
    //"Logs - Marketing campaigns" => "Logi - Akcje marketingowe",
    //"Logs - Polls" => "Logi - Ankiety",

    
    // Mailer
    "Mail was successfully send." => "Mail został wysłany.",
    "Add new mail" => "Napisz nowy e-mail",
    "Templait was successfully edited." => "Zmiany w szablonie zostały zapisane.",
    "Send email" => "Wyślij wiadomość",
    "Meeting reminder" => "Informacja o spotkaniu",

    // Meeting

        //form
        "Executed at:" => "Wykonano:",


    // Contact Import
    //"Import was finished" => "Import został wykonany.",
    //" Number of contacts found in file: " => " Ilość odnalezionych kontaktów w pliku: ",
    //" Invalid contacts: " => " Kontakty zawierające błędy: ",
    //" Contact with valid data: " => " Kontakty zawierające poprawne dane: ",
    //" Contacts that already exist in database: " => " Duplikaty już istniejących kontaktów: ",
    //" Contacts added to data base: " => " Dodanych kontaktów do bazy danych: ",
    " Invalid contacts was not imported and were saved into file: " => " Kontakty które nie zostały zaimportowane i zawierają błędy zostały zapisane w pliku: ",
    "Data was successfully removed." => "Dane zostały usunięte.",
    "Are you sure you want to delete selected data?" => "Czy jesteś pewnien, że chcesz usunąc wybrane dane?",
    "Import contacts" => "Zaimportuj kontakty",
    "Contacts import" => "Import kontaktów",
    "No compatible data in imported file." => "W importowanym pliku nie ma poprawnych danych, które mogłyby zostać zaimportowane.",

    // Mailer Template
    //"Update mailer template" => "Edycja szablonu maila",
    //"Add new template" => "Dodaj nowy szablon",
    //"Mailer template" => "Szablon maila",
    //"Edit template" => "Edytuj szablon",
    "Templayed was successfully added." => "Nowy szablon został dodany.",
    "Are you sure you want to delete selected template?" => "Czy jesteś pewien, że chcesz usunąć wybrany szablon?",

    // marketingcampaign
    "Are you sure you want to delete selected campaign?" => "Czy jesteś pewien, że chcesz usunąć wybraną akcję marketingową?",
    "Add new campaign" => "Dodaj akcję marketingową",
    "Add new Marketing campaign" => "Dodaj akcję marketingową",
    "Update marketing campaign" => "Edytuj akcję marketingową",
    "Marketing campaigns" => "Akcje marketingowe",
    "Marketing campaign was successfully created." => " Nowa akcja marketingowa została utworzona.",
    "Marketing campaign was successfully edited." => "Zmiany w akcji marketingowej zostały zapisane.",
    "Selected contacts were successfully assign to campaign." => "Wybrane kontakty zostały przypisane do akcji marketingowej.",
    "Assign clients" => "Przypisz klientów",
    "Assign users" => "Przypisz użytkowników",
    "Marketing campaign was successfully published." => "Akcja marketingowa została opublikowana.",
    "W trakcie publikowania akcji marketingowej wystąpił błąd przy dodawaniu użytkowników." => "Error occured while publishing users werent assigned.",
    "W trakcie publikowania akcji marketingowej wystąpił błąd przy dodawaniu klientów." => "Error occured while publishing, clients werent assigned.",
    "Assigned clients" => "Przypisani klienci",
    "Assigned users" => "Przypisani użytkownicy",
    "Finish" => "Zakończ",
    "Are you sure you wish to close this marketing campaign?" => "Czy na pewno chcesz zakończyć wybraną akcję marketingową?",
    "Marketing campaign was closed." => "Akcja marketingowa została zamknięta",
    "Marketing camapaign was deleted." => "Akcja marketingowa została usunięta.",
    "Selected client was deleted from current marketing action." => "Wybrany klient został usunięty z bieżącej akcji marketingowej.",
    "Are you sure you want to delete selected client?" => "Czy jesteś pewien, że chcesz usunąć wybranego klienta z bieżącej akcji marketingowej?",
    "Assign new user" => "Przypisz kolejnego użytkownika",
    "New user was assigned to current marketing action." => "Nowy użytkownik został przypisany do bieżącej akcji marketingowej",
    "Assign selected" => "Dopisz wybrane",
    "Are you sure you want to delete selected user?" => "Czy jesteś pewien, że chcesz usunąć wybranego użytkownika?",
    "Selected user was deleted from current marketing action." => "Wybrany użytkownik został usunięty z listy przypisanych do danej akcji marketingowej.",
    "Select to assign" => "Wybierz do przypisania",
    "Assign" => "Przypisz",
    "Assign new client" => "Przypisz kolejnego klienta",
    "select all" => "wybierz wszystkie",
    "deselect all" => "odznacz wszystkie",
    "Show all assigned clients" => "Wszyscy przypisani klienci",
    "Show not contacted clients" => "Klienci do obdzwonienia",
    "Show contacted clients" => "Obdzwonieni klienci",
    "Create alike" => "Utwórz podobną",
    "Creates new campaign with same users and clients" => "Tworzy nową kampanię z tymi samymi użytkownikami i klientami",
    "Marketing campaign title" => "Tytuł akcji marketingowej",


    // message
    "New message" => "Nowy komunikat",

        // form
        "Announcement:" => "Komunikat:",
        "Display from:" => "Wyświetlaj od:",
        "Display to:"   => "Wyświetlaj do:",
        "Important?"    => "Ważny?",

    
    "Message was successfully added." => "Pomyślnie dodano komunikat.",
    "Message was successfully edited." => "Pomyślnie edytowano komunikat.",
    "Message was successfully removed." => "Pomyślnie usunięto komunikat.",
    "Message was successfully restored." => "Pomyślnie przywrócono komunikat.",

    // osoba fizyczna
    "New customer modulo" => "Nowe modulo klienta",
    "The agreement was revised." => "Umowa została odświeżona.",
    "No connection to an external system." => "Brak połączenia z zewnętrznym systemem.",
    "You can not add new client without previous search for it in the application process: Social Security Number and ID number." => "Nie możena dodawać klienta bez uprzedniego wyszukania go w aplikacyjnej po: PESEL, Nr Dok. Tożsamości!",
    "At this time you can not change your Social Security Number. Field value is overwritten with the right Social Security number." => "Na tym etapie procesu nie możesz zmienić PESELU. Warotść pola została nadpisana właściwym numerem PESEL.",
    "At this time you can not change your ID number. Field value is overwritten with the right ID number." => "Na tym etapie procesu nie możesz zmienić numer dokumentu tożsamości. Warotść pola została nadpisana właściwym numerem dokumentu tożsamości.",
    "You can not change Social Security Number." => "Nie można zmienić numeru PESEL.",
    "You can not change ID number." => "Nie można zmienić numeru dokumentu tożsamości.",
    "Client does not exist in DEF. Before saving to DEF3000 print information card." => "Klient nie istnieje w DEF. Przed zapisem w DEF3000 należy wydrukować kartę informacyjna.",
    "Unrecognized error occurred." => "Zaistniał nierozpoznany problem.",
    "At this time you can not change search parameters. To change search parameters go to Search client." => "Na tym etapie procesu nie możesz zmienić paramterów wyszukiwania. W celu zmiany kryteriów wyszukiwania przejdź do Wyszukaj klienta.",
    "Client not found in DEF3000." => "Klient nie znaleziony w DEF3000.",
    "Customer data has changed in relation to data saved in DEF3000. Print information card again." => "Dane klienta zmieniły się w stosunku do danych na DEF3000. Wydrukuj ponownie Kartę Informacyjną",
    "Verification of DEF3000 has not been performed!" => "Nie wykonano weryfikacji z DEF3000!",
    "Data loaded form DEF3000!" => "Dane załadowane z DEF3000!",
    "Error occurred while trying to generate KI." => "Problem z wygnerowaniem KI.",
    "After verification of data and the signing of the Customer Information Card add customer to DEF3000." => "Po weryfikacji danych i podpisaniu Karty Informacyjnej Załóż klienta w DEF3000.",
    "Verification MIG-DZ unsuccessfull!" => "Weryfikacja MIG-DZ nieprawidłowa!",
    "Verification MIG-DZ successfull!" => "Weryfikacja MIG-DZ prawidłowa!",
    "Customer was successfully saved in DEF. Choose an action from the menu on the left." => "Operacja zapisania klienta w DEF zakończona powodzeniem. Wybierz akcję z menu po lewej stronie.",
    "Error occurred while trying to save customer in DEF!" => "Problem z zapisem w DEF!",
    "The customer you are trying to add a joint owner does not have active Modulo." => "Klient do którego próbujesz dodać współwłaściciela nie posiada aktywnych MODULO.",
    "Selected client has no record of DEF3000." => "Wybrany klient nie posiada kartoteki w DEF3000.",
    "Customers products could not be found!" => "Problem z odnalezienim produktów klienta!",
    "Customer was successfully removed." => "Operacja usunięcia klienta z aplikacji zakończona powodzeniem.",

    // poll
    "Add new poll" => "Dodaj nową ankietę",
    "New poll" => "Nowa akieta",
    "Are you sure you want to delete selected poll?" => "Czy jesteś pewien, że chcesz usunąć wybraną ankietę?",
    "Add question" => "Dodaj pytanie",
    "Poll" => "Ankieta",
    "Edit poll" => "Edycja ankiety",
    "Polls questions" => "Pytania w ankiecie",
    "Edit question" => "Edycja pytania",
    "Are you sure you want to delete selected questions and its answers?" => "Czy na pewno chcesz usunąć wybrane pytanie i przypisane do niego odpowiedz?",
    "Question was edited succesfully." => "Zmiany w pytaniu zostały zapisane",
    "Back to questions list" => "Powrót do listy pytań",
    "Question answers" => "Odpowiedzi do pytania",
    "Polls question details" => "Szczegóły pytania",
    "Add answer" => "Dodaj odpowiedź",
    "Are you sure you want to delete selected answer?" => "Czy jesteś pewien, że chcesz usunąć wybraną odpowiedź?",
    "Polls questions answer" => "Odpowiedzi do pytania",
    "Back to question details" => "Powrót do opisu pytania",
    "Edit answer" => "Edytuj odpowiedź",
    "Answer was edited succesfully." => "Zmiany w odpowiedzi zostały zapisane.",
    "Answer was successfully deleted." => "Odpowiedź została usunięta",
    "View/Fill Poll"=> "Zobacz/Wypełnij ankietę",
    "Question and answers were successfully deleted." => "Pytanie i odpowiedzi zostały usunięte.",
    "Poll votes were saved." => "Ankieta została zapisana.",
    "Poll was successfully removed." => "Ankieta została usunięta.",
    "Polls were assigned to added event." => "Ankiety zostały przypisane do dodanego wydarzenia.",

    "Poll title" => "Tytuł ankiety",
    "Visible from" => "Wyświetlaj od",
    "Visible to" => "Wyświetlaj do",
    "Poll type" => "Rodzaj ankiety",
    "Assign poll with common questions" => "Przypisana ankieta z pytaniami domyślnymi",
    "Poll description" => "Opis ankiety",
    "Question" => "Pytanie",
    "Answer type" => "Typ odpowiedzi",
    "Answer" => "Odpowiedź",


    // profile
    "Edit permissions" => "Edytuj uprawnienia",
    "Profile" => "Profile",
    "Show profiles" => "Pokaż profile",

    "User profiles was successfully edited. If you added new user you should also add permissions." => "Pomyślnie edytowano profile użytkownika. Jeśli dodałeś profil, to powinieneś teraz dodać do niego uprawnienia.",
    "Profiles permissions was successfully edited." => "Pomyślnie edytowano uprawnienia profilu.",
    "Profiles permissions was successfully cloned." => "Pomyślnie sklonowano uprawnienia profilu.",
    "User was successfully assigned to group." => "Pomyślnie przypisano użytkownika do grupy.",

    // product
    "Subtype:" => "Podtyp:",
    "New product" => "Dodaj nowy produkt",
    "New product type" => "Nowy typ produktów",
    "Add proposal template" => "Dodaj szablon wniosków",
    "Is required?" => "Wymagany?",
    "Product:" => "Produkt:",
    "Dictionary:" => "Słownik:",
    "Preview:" => "Podgląd:",
    "What to add:" => "Wybierz co dodać:",
    "Category" => "Kategoria",
    "Type name:" => "Nazwa typu:",
    "Subtype name:" => "Nazwa podtypu:",


    // privilegs

        // form
        "Branch:" => "Oddział:",
        "Account valid to:" => "Konto ważne do:",
    

    // reminder
    "Reminder was successfuly saved." => "Przypomnienie zostało zapisane.",
    "Reminder was successfully removed." => "Przypomnienie zostało usunięte",
    "Reminder was successfully edited." => "Zmiany w przypomnieniu zostały zapiane.",
    "Add new reminder" => "Dodaj przypomnienie",
    "Remind at:" => "Data przypomnienia:",
    "Assign Client:" => "Przypisz klienta:",
    "Assign product:" => "Przypisz product:",
    //"Update reminder" => "Edytuj przypomnienie",
    "Is important:" => "Ważne:",
    "Reminder" => "Przypomnienie",
    "Sms messages was successfully send." => "Smsy zostały wysłane.",
    "E-mail messages was successfully send." => "E-maile zostały wysłane.",
    "Are you sure you want to delete selected reminder?" => "Czy jesteś pewien, że chcesz usunąć wskazane przypomnienie?",


    // role
    "New role" => "Nowa rola",

    "New role was successfully added." => "Pomyślnie dodano rolę.",
    "New role was successfully edited." => "Pomyślnie edytowano rolę.",
    "Are you sure you want to delete selected role?" => "Czy jesteś pewien, że chcesz usunąć wybraną rolę?",
    "Role was successfully deleted." => "Rola została usunięta",

    // slownik
    "Error while dictionary synchronization with DEF!" => "Problem z synchronizacją słownika z DEF!",

    // system
    "Error while clearing cache!" => "Problem podczas czyszczeia cache!",

    // user
    "Clone profile" => "Klonowanie profilu",
    "Group" => "Grupa",
    "Assign to group" => "Przypisz do grupy",
    //"New users group" => "Nowa grupa użytkowników",
    //"Back to users group" => "Powrót - lista użytkowników",
    //"Users groups list" => "Lista grup użytkowników",

        // form
        "Clone from:" => "Klonuj z:",
        "Clone to:"   => "Klonuj do:",
        "E-mail footer:" => "Stopka maila:",
        "Blocked reason:" => "Powód blokady:",
        "Branch employee:" => "Pracownik oddziału:",
        "Users group:" => "Grupa użytkowników:",
        "Lock start:" => "Początek blokady:",
        "Lock end:" => "Koniec blokady:",
        "Group:" => "Grupa:",

    // modal confirm
    "Are you sure you want to delete selected feedback?" => "Czy na pewno chcesz usunąć wybrane zgłoszenie?",
    "Are you sure you want to delete selected branch?" => "Czy na pewno chcesz usunąć wybrany oddział?",
    "Are you sure you want to delete selected branch group?" => "Czy na pewno chcesz usunąć wybraną grupę?",
    "Are you sure you want to delete selected filter?" => "Czy na pewno chcesz usunąć wybrany filtr?",

    "Doesn't answer" => 'Nie odbiera',
    "Meeting" => "Spotkanie",
    "Phone" => 'Telefon',
    "Delete" => "Usuń",

    "Hello" => "Witaj",
    //"Your new password for the system is" => "Twoje nowe hasło do systemu",
    "This is autogenerated email. Please, do not reply." => "To jest wiadomość wygenerowana automatycznie. Proszę na nią nie odpowiadać.",
    
    "Guardian" => "Opiekun",
    "Next day" => "Następny dzień",
    "Previous day" => "Poprzedni dzień",
    "Reservation" => "Rezerwacja",

    "Login" => "Zaloguj",
    //'%1$s changed from %2$s to %3$s' => '%1$s zmieniono z %2$s na %3$s',

    "choose" => "wybierz",
    "Closest meeting reminder" => "Informacja o najbliższym spotkaniu",

    "Viewed."=>"Wyświetlenie.",
    "Data changed."=>"Zmieniono dane.",

    "Updated width revision." => "Zapisano zmiany i utworzono nową rewizję.",

    //Agreement
    "Agreement:" => "Zgoda:",
    "Loading. Please wait." => "Proszę czekać. Trwa ładowanie.",

    //Kolejki Ticketów
    "Queues" => "Kolejki",
    "Tickets" => "Zadania",
);
