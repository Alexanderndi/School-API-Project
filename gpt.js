function countAlphabets(sentence) {
    var count = {};
    sentence = sentence.toLowerCase();
    for (var i = 0; i < sentence.length; i++) {
      var character = sentence.charAt(i);
      if (character.match(/[a-z]/i)) {
        if (count[character]) {
          count[character]++;
        } else {
          count[character] = 1;
        }
      }
    }
    return count;
  }
  
  console.log(countAlphabets("The quick brown fox jumps over the lazy dog."));
