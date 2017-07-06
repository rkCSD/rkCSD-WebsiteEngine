# rkCSD-WebsiteEngine
A simple, modular and flexible CMS.

Copyright © 2017 rkCSD Eu email@rkcsd.com. Visit our website: http://www.rkcsd.com/

# Installing

You'll need a webserver with PHP >= 5.3 and a mysql database.

1. Place a [release](https://github.com/rkCSD/rkCSD-WebsiteEngine/releases) inside a directory on an apache-webserver.
2. Import the `DB.sql` in your database
3. Create a new `config.ini` inside the `/config`-Directory and edit the necessary values. You'll be up and running if you only edit the ones under the `mysql` section

# How-To
[Full Documentation (German)](http://wiki.reneknipschild.net/dev:web:rkcsdengine)

## Create an adminaccount

Insert a record for every user into the `Users`-Table. You'll need a hashed password here which you can get from the `apps/WebAdmin/new-user.php`-File, simply edit the file with your
 password and view the file in your browser. Then insert the hash.
 
You can enable or disable an account via the `isActive`-property.

So for example:

```mysql
INSERT INTO `Users` (`LoginName`, `LoginPass`, `Realname`, `Emailadress`, `isActive`) VALUES
('admin', '$2y$10$txdbPmpNHbEi4CJFTRtDAeZ.F6QrGhdNtWkQcPfGp2Iizx8YbU4ym', 'Admin', 'your@email.com', 1);
```

Normally, there is a user called `admin` with the password `admin` - You should either delete the user or change its password!

## Template

To have the website designed the way you want it, simply edit the template file specified in `template` in the `config.ini` (usually `content/tpl/main_template`). 
The included `main_template.tpl` provides some examples on how to include other templates.

## Add a new page

To to this, you need to insert a bunch of records.
First, insert one into `MetaData`:

```mysql
INSERT INTO `MetaData` (`idMetaData`, `Created`, `LastModified`, `Lang`, `Title`, `Header`, `Keywords`, `Descr`) 
VALUES (NULL, '2017-07-06 00:00:00', '2017-07-06 00:00:00', 'DE', 'Test', NULL, 'test, cms, stuff', 'descripption goes here...');
```
Note its new id.

Then insert a record into `Content`;

```mysql
INSERT INTO `Content` (`idContent`, `Contentcol`, `MetaData_idMetaData`, `ContentGroups_idContentGroups`) 
VALUES (NULL, 'YourContent goes here...', '<the id from the record you previously inserted into MetaData>', '1');
```
Note its new id.

And the finally insert your route into `Root2Leaves`:

```mysql
INSERT INTO `Root2Leaves` (`idRoot2Leaves`, `rURL`, `DisplayName`, `isRoot`, `isToplevel`, `Content_idContent`) 
VALUES (NULL, 'test_url', 'Testpage-Title', '0', '1', '<your contentid goes here>')
```

* `rURL` is the Url of the new page. Without slash at the beginning.
* `DisplayName` is used in the menu.
* `isRoot` should only one row have true. Whenever the user accesses your site via `/`, it gets redirected to this page (only if rUrl of that page is not empty).
* `isToplevel` defines if the Site is shown in the menu at top level or not.
* `Content_idContent` is the id of the content record in `Content`

## Directory Structure

### Apps

Apps go in the `/apps` folder. Every app gets its own folder.

### Config

Configuration has its own directory under `/config` in order to be mountable into containers.

### Content

The `/content` folder is ment for all Templates/CSS/JS regarding the design of your website.

### Other Extensions/Javascripts

Place all your extra extensions and javascripts under `/extensions`.

# License

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.