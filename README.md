# Lochness Starter Project
A wordpress starter project for Lochness Digital client websites.

## Starting a new project

1. Create a new repository in github named `projectname-year`.
2. Clone repository locally.
3. Clone the lochness-starter-project repository via ssh or pull down the latest if already cloned.
```bash
git clone git@github.com:christopherhodges/lochness-starter-project.git
```
4. Copy everything from the `lochness-starter-project` repo over to your new repo except the `.git` directory.
5. Intialize DDEV from the root directory of the new project and follow the guidelines in the bullets below.
    - **Project Name:** `projectname-year`
    - **Docroot Location:** web
    - **Project Type:** wordpress
```bash
ddev config
```
6. Copy `.env.example` to a new file named `.env.local` and update the following:
    - **DB_HOST:** `ddev-projectname-year-db`
    - **WP_HOME:** `https://projectname-year.ddev.site`
    - **Genterate new salts:** https://roots.io/salts.html *(use Env Format)*
7. Start DDEV.
```bash
ddev start
```
8. Install composer dependencies.
```bash
ddev composer install
```
8. Run the WordPress installation by going to `https://projectname-year.ddev.site` and following the guidelines below.
    - **Site Name:** `Project Name Year`
    - **Username:** `lochness-admin`
    - **Password:** *default lochness digital pw*



## License

[GNU General Public License v3.0](https://choosealicense.com/licenses/gpl-3.0/)