
  import $ from 'jquery';
  import _ from 'lodash';
  import Handlebars from 'handlebars/dist/handlebars.min.js';

  window.jQuery = $;
  window.$ = $;

  // Get Data from json file
  var jsonPostsUrl = 'http://localhost/MAQE-TNS/posts.json';
  var jsonAuthorsUrl = 'http://localhost/MAQE-TNS/authors.json';

  $.when(
      $.getJSON(jsonPostsUrl),
      $.getJSON(jsonAuthorsUrl)
  ).done(function(posts, authors) {
    var postList = _.slice(posts[0], 0, 8);
    var authorList = authors[0];
    var templateScript = $('#post-template').html();
    var template = Handlebars.compile(templateScript);

    Handlebars.registerHelper('checkOddRow', function(rowIndex) {
      if(rowIndex % 2 == 0) {
        return '';
      }

      return 'odd';
    });

    Handlebars.registerHelper('author', function(id) {
      var author = _.find(authorList, ['id', id]);      
      var result = `<div class="author">
                <img class="author-img" src="`+author['avatar_url']+`" alt="Author Avatar">
                <div class="author-name">`+author['name']+`</div>
                <div>`+author['role']+`</div>
                <div>`+author['place']+`</div>
              </div>`;
      return new Handlebars.SafeString(result);
    });
    
    $(".posts").append(template(postList));
    console.log('append complete.');

    var pageCount = 8;
    var tpPagingScript = $('#paging-template').html();
    var tp = Handlebars.compile(tpPagingScript);    

    Handlebars.registerPartial('paging-number', function() {
      var result = '';
      for(var i=1; i<=pageCount; i++) {
        if(i == 1) {
          result = result + '<li class="active"><a href="#">'+i+'</a></li>';
        }else{
          result = result + '<li><a href="#">'+i+'</a></li>';
        }        
      }

      return result;
    });

    $(".paging").append(tp());
    
  });
  

