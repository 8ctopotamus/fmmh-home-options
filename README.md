# FindMyMobileHome Home Options
Manage additional home options.

## Install Dependencies
Run `npm install`

## End Users 
### CSV Template
Use this [CSV template](example-options.csv) to populate your data. Leave the header row, change other rows as needed.

#### CSV Formatting Rules:
* The first row must be your headers
* The **first two colums** must be slug and the option respectivley.
* For binary options use `true` or `false`
* When grouping options for a home, put the default first.

#### Todo:
- Closed accordion: Show title, price
- Show in open accordion: Description, image
- Request a quote button with list of options as another param