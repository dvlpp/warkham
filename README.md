# Warkham

## Setup the repository

```bash
$ npm install
$ composer self-update
$ composer install
```

## Compiling assets

```
$ grunt
```

Or during development, to make assets recompile as they're changed:

```
$ grunt watch
```

## Running the tests

```
$ phpunit
```

## Roadmap

| Class    | Method                  | Status |
| -------- | ----------------------- | ------ |
| Abstract | addClass                | V      |
| Abstract | enable                  | V      |
| Abstract | forceValue              | V      |
| Abstract | setValue                | V      |
| Checkbox | check                   | V      |
| Checkbox | text                    | V      |
| Choice   | multiple                | V      |
| Choice   | setAvailableValues      | V      |
| Choice   | ui                      | V      |
| Date     | max                     |        |
| Date     | min                     |        |
| Date     | withHours               |        |
| Date     | withMinutes             |        |
| File     | accept                  | V      |
| File     | max                     | V      |
| File     | multiple                | V      |
| File     | progress                | V      |
| File     | thumbnail               | V      |
| File     | uploadRoute             | V      |
| Filelist | addable                 |        |
| Filelist | removable               |        |
| Filelist | setValue                |        |
| Filelist | sortable                |        |
| List     | addable                 |        |
| List     | removable               |        |
| List     | setValue                |        |
| List     | sortable                |        |
| Oracle   | forceValue              |        |
| Oracle   | remote                  | V      |
| Oracle   | setDataset              |        |
| Oracle   | setRemoteRoute          | V      |
| Oracle   | setValue                |        |
| Taglist  | max                     |        |
| Taglist  | setAvailableValues      |        |
| Taglist  | setTags                 |        |
| Text     | mask                    | V      |
| Textarea | ui                      | V      |