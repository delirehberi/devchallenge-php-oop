# 7 Cups Dev Team PHP Object Oriented Programming Challenge

1. Copy this template repository by clicking "Use this template"
2. Commit to your repository to meet the goal set out below. (Evaluation will be based largely on meeting defined guidelines, reaching the expected result, and efficiency.)
3. Share your completed repository.


## Guidelines

1. Parse a data source, in this case chat messages and related users
2. Create a class to convert the records into PHP objects
    1. Each Message object should be JSON Serializable
    2. When JSON serialized, each "ts" (unix timestamp) should be converted to a standard timestamp in form "YYYY-MM-DD HH:MM:SS" and should be converted to Eastern Timezone (GMT-4)
    3. There should be a method to return the corresponding user based on "userid"
    4. When JSON serialized, the corresponding user object should be serialized and included as well
3. Create a Class to convert user records to PHP objects for use in #2
    1. Make sure not to echo or json encode any sensitive data to the front end
3. Create a way to query by "chatid" parameter to produce a filtered collection of chat message objects in order by "ts" (unix timestamp)
4. Update index.php to call your classes/methods as described in the file.