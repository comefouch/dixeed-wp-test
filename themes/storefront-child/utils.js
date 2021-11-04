function getIp() {
    const form = new FormData();
    form.append("action", "get_ip");
    const params = new URLSearchParams(form);
    fetch(custom_storefront_utils_ajax.ajax_url, {
            method: "post",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                "Cache-Control": "no-cache",
            },
            body: params,
        })
        .then((res) => res.json())
        .then((data) => {
            document.getElementById("get_id_response").innerHTML = data.ip;
        });
}