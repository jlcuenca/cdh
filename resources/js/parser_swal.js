// This only works when is used on axios
export function AxiosSwalErrorParser(error) {

    console.error(error)
    const res = error.response;
    const bag = res.data.errors;

    let html = '<ul>';

    let errors_list = Object.keys(bag).map(key => {

        let message = bag[key][0];
        html += `<li>${message}</li>`;

        return {
            field: key,
            message: message
        }
    })

    html += '</ul>';

    return {
        statusCode: res.status,
        message: res.data.message,
        errors: bag,
        errors_list: errors_list,
        as_html: html
    }
}