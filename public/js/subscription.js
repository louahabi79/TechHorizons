document.addEventListener("DOMContentLoaded", function () {
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
});
