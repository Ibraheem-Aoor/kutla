export function getFileFontIcon(file) {
    let ext = file.split('.').pop();

    if(ext == 'jpg' || ext == 'jpeg' || ext == 'png') {
        return `<i class="fa fa-file-image-o" aria-hidden="true"></i>`;
    }
    else if(ext == 'rar' || ext == 'rar') {
        return `<i class="fa fa-file-archive-o" aria-hidden="true"></i>`;
    }
    else if(ext == 'pdf') {
        return `<i class="fa fa-file-pdf-o" aria-hidden="true"></i>`;
    }
    else if(ext == 'doc' || ext == 'docx') {
        return `<i class="fa fa-file-word-o" aria-hidden="true"></i>`;
    }
    else if(ext == 'xls' || ext == 'xlsx') {
        return `<i class="fa fa-file-excel-o" aria-hidden="true"></i>`;
    }
    else {
        return `<i class="fa fa-file-code-o" aria-hidden="true"></i>`;
    }
}