# TestDrive

=== Plugin Name ===

Contributors:		daleksandrov 
Donate link:		http://inform.mk
Tags:			1.0.0
Requires at least:	1.0.0
Tested up to:		4.2
Stable tag:		1.0.0
License:		GPLv2 or later
License URI:		http://www.gnu.org/licenses/gpl-2.0.html

TestDrive is a plugin that replaces the main feature of TestFlight - installing
an iOS app over-the-air on an iOS device through a click on a link.


== Description ==

= Purpose =
TestDrive is a plugin that replaces the main feature of TestFlight - installing
an iOS app over-the-air on an iOS device through a simple click on a link.

= Usage =
Version 1.0 of TestDrive does two things:
1) It allows an iOS app developer to upload an .ipa and a .plink file to the
WordPress Media Library from their Mac/PC.
2) It allows an iOS app tester to select a .plink file from the WordPress Media
Library and to obtain an itms-services link, which they can touch to install
the iOS app on their iOS device.
Subsequent versions will have a much more TestFlight-like look and feel. It
will support an easy automated workflow for non-technical testers to install
and test your iOS app.


== Installation ==

1. Create a self-signed certificate as per:
   https://blog.httpwatch.com/2013/12/12/five-tips-for-using-self-signed-ssl-certificates-with-ios/
2. Make the .cer certificate file be available on a separate non-https website
   and open that website from your iOS device to install the certificate, or
   email it to your iOS device.
   NOTE: Don't simply open the https website from your iOS device without
         first installing the website certificate on that device - the browser
         on your iOS device will simply ignore the certificate on your https
         website, but it will *not* warn you that doing this will cause the iOS
         device to refuse to install your iOS app later in the process.
3. Setup SSL on your Apache server as per:
   https://httpd.apache.org/docs/2.4/ssl/ssl_howto.html
4. Install WordPress on your Apache server as per:
   https://codex.wordpress.org/Installing_WordPress#Famous_5-Minute_Install
5. Open the browser on your PC, login to your WordPress website and go to
   Plugins:
   https://my-website.com/wp-admin/plugins.php
6. Click the Add New button at the top of the Plugins page.
7. Search for:
   testdrive
   NOTE: You can manuall download the TestDrive plugin from: 
   https://wordpress.org/plugins/testdrive/
8. Click the Install Now button and then Activate the TestDrive plugin.
9. Compile your iOS app and create and ad-hoc archive as per:
   http://stackoverflow.com/questions/19081180/ad-hoc-deployment
   NOTE: Be sure to follow all of their recommendations!
   NOTE: Troubleshoot as per:
	 https://stackoverflow.com/questions/20276907/enterprise-app-deployment-doesnt-work-on-ios-7-1
10. Edit your .plist file as per:
    https://stackoverflow.com/questions/26306876/xcode6-how-to-export-an-app-with-plist-for-enterprise-distribution
    NOTE: If your .ipa file has a space in the filename, be careful because
          WordPress will display the .ipa file just as you named it, but it
          will save it with a hyphen replacing the space in the filename, thus
          you should add the correct hyperlink to your .ipa file in your .plink
          file. Otherwise, upon trying to install the iOS app to your iOS device
          you will get the error: "Unable to install MyApp!"
11. Open the command line and include the MIME types for .ipa and .plink in the
    following file:
    /var/www/my-website/wordpress/wp-includes/functions.php
    NOTE: If you don't, you won't be able to upload the .ipa & .plist files to
          WordPress!
12. Open the command line and change the following line in
    /etc/php5/apache2/php.ini:
        upload_max_filesize = 64M
    NOTE: If you don't, you won't be able to upload the .ipa file, whose size is
          definitely greater than the default upload max filesize of 2 MB!
    NOTE: I also modified the following files, but I'm unsure that it makes a
          difference:
	  /var/www/testdrive/wordpress/wp-config.php
 	  /etc/apache2/mods-enabled/php5.conf
    @TODO: Test whether the above two files make a difference!
13. Open the browser on your PC, login to your WordPress website, and go to
    Media to upload your .ipa and .plist files:
    https://my-website.com/wp-admin/upload.php
14. Open the browser on your iOS device, login to your WordPress website and go
    to the TestDrive plugin page:
    https://my-website.com/wp-admin/admin.php?page=td
15. Touch the "Select .plist File" button, select one, and touch the "Insert"
    button.
16. Touch the "Download!" link - the iOS app should begin installing on your
    iOS device, please be patient.


== Frequently Asked Questions ==


== Screenshots ==


== Changelog ==


== Support ==

Currently we provide NO TECH SUPPORT FOR THIS PLUGIN - use at your own risk.
