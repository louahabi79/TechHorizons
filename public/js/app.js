document.addEventListener("DOMContentLoaded", function () {
    // Subscription buttons

    const subscriptionButtons = document.querySelectorAll(
        ".subscription-button"
    );
    subscriptionButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const form = this.closest("form");
            const button = this;
            fetch(form.action, {
                method: "POST",
                body: new FormData(form),
            }).then(function (response) {
                if (response.ok) {
                    if (button.innerText.trim() === "Subscribe") {
                        button.innerText = "Unsubscribe";
                    } else {
                        button.innerText = "Subscribe";
                    }
                }
            });
        });
    });
    // Rating form

    const ratingForms = document.querySelectorAll('form[action*="/ratings"]');
    ratingForms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            const formElement = this;
            const articleId = formElement.querySelector(
                'input[name="article_id"]'
            ).value;
            fetch(formElement.action, {
                method: "POST",
                body: new FormData(formElement),
            }).then((response) => {
                if (response.ok) {
                    const selectContainer = formElement.closest("div");
                    fetch(window.location.href)
                        .then((response) => response.text())
                        .then((html) => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(
                                html,
                                "text/html"
                            );
                            const newContent =
                                doc.querySelector(".p-6.text-gray-900");
                            selectContainer.innerHTML = newContent.innerHTML;
                        });
                }
            });
        });
    });
    // Comment form
    const commentForms = document.querySelectorAll('form[action*="/comments"]');
    commentForms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            const formElement = this;
            fetch(formElement.action, {
                method: "POST",
                body: new FormData(formElement),
            }).then((response) => {
                if (response.ok) {
                    const commentContainer = document.querySelector(
                        "#messages-container"
                    );
                    fetch(window.location.href)
                        .then((response) => response.text())
                        .then((html) => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(
                                html,
                                "text/html"
                            );
                            const newContent = doc.querySelector(
                                "#messages-container"
                            );
                            commentContainer.innerHTML = newContent.innerHTML;
                            formElement.reset();
                        });
                }
            });
        });
    });
});

function toggleMenu(button) {
    const optionsMenu = button.nextElementSibling;
    optionsMenu.classList.toggle("hidden");
}
