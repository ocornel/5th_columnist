function systemSearch(term) {
    $("#search_results").html('<span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;Please wait while searching.').addClass("text-info").removeClass('hidden');
    $.ajax({
        type: "GET",
        url: '/search',
        data: {
            'search_text': term,
        },
        success: function (data) {
            $('body').addClass('layout-header-fixed');
            $("#search_results").html("<h3>Results for " + term + "</h3>" + data['drivers'] + data['customers'] + data['vehicles'] + data['towns']).removeClass("text-info").removeClass("text-danger");
        },
        error: function () {
            $("#search_results").html("An Error Occurred.").removeClass("text-info").addClass("text-danger");
        }
    });
}

// set required

$("input[required]").parent().addClass("required");
$(".dataTable").dataTable();

// lazy load images
const config = {
    rootMargin: '0px 0px 50px 0px',
    threshold: 0
};

let observer = new IntersectionObserver(function (entries, self) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            preloadImage(entry.target);
            self.unobserve(entry.target)
        }
    });
}, config);

function preloadImage(target) {
    const lazyImage = target;
    lazyImage.src = lazyImage.dataset.src;
}

const imgs = document.querySelectorAll('[data-src]');
imgs.forEach(img => {
    observer.observe(img);
});

// Post actions
function likePost(post_id) {
    console.log('liked post ' + post_id);
}

function hatePost(post_id) {
    console.log('hated post ' + post_id);
}

// Comment actions
function likeComment(comment_id) {
    console.log('liked comment ' + comment_id);
}

function hateComment(comment_id) {
    console.log('hated comment ' + comment_id);
}

function replyComment(comment_id, comment_content) {
    console.log('replying to comment: ' + comment_content);
    document.getElementById('parent_comment_id').value = comment_id;
    document.getElementById('target_comment').innerHTML = "Replying to: " + comment_content;
}

// editor
$(document).ready(function () {
    $('.public-editor').summernote({
            placeholder: 'Type Content',
            // toolbar: [
            //     ['style', ['bold', 'italic', 'underline', 'clear']],
            //     ['insert', ['hr', 'link', 'table']],
            //     ['font', ['strikethrough', 'superscript', 'subscript']],
            //     ['fontsize', ['fontsize']],
            //     ['color', ['color']],
            //     ['para', ['ul', 'ol', 'paragraph']],
            //     ['misc', ['fullscreen', 'undo', 'redo']],
            // ]
        }
    );
});

function linkText(input_string) {
    return input_string.replace(/ /g, '-').toLowerCase();
}

