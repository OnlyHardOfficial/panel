"use strict";

// Copyright (c) 2015 - 2016 Dane Everitt <dane@daneeveritt.com>
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in all
// copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.
class ActionsClass {
    constructor(element, menu) {
        this.element = element;
        this.menu = menu;
    }

    destroy() {
        this.element = undefined;
    }

    folder() {
        const nameBlock = $(this.element).find('td[data-identifier="name"]');
        const currentName = decodeURIComponent(nameBlock.attr('data-name'));
        const currentPath = decodeURIComponent(nameBlock.data('path'));

        let inputValue = `${currentPath}${currentName}/`;
        if ($(this.element).data('type') === 'file') {
            inputValue = currentPath;
        }
        swal({
            type: 'input',
            title: 'Create Folder',
            text: 'Please enter the path and folder name below.',
            showCancelButton: true,
            showConfirmButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            inputValue: inputValue
        }, (val) => {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-Access-Token': '{{ $server->daemonSecret }}',
                    'X-Access-Server': '{{ $server->uuid }}'
                },
                contentType: 'application/json; charset=utf-8',
                url: '{{ $node->scheme }}://{{ $node->fqdn }}:{{ $node->daemonListen }}/server/file/folder',
                timeout: 10000,
                data: JSON.stringify({
                    path: val,
                }),
            }).done(data => {
                swal.close();
                Files.list();
            }).fail(jqXHR => {
                console.error(jqXHR);
                var error = 'An error occured while trying to process this request.';
                if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                    error = jqXHR.responseJSON.error;
                }
                swal({
                    type: 'error',
                    title: '',
                    text: error,
                });
            });
        });
    }

    move() {
        const nameBlock = $(this.element).find('td[data-identifier="name"]');
        const currentName = decodeURIComponent(nameBlock.attr('data-name'));
        const currentPath = decodeURIComponent(nameBlock.data('path'));

        swal({
            type: 'input',
            title: 'Move File',
            text: 'Please enter the new path for the file below.',
            showCancelButton: true,
            showConfirmButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            inputValue: `${currentPath}${currentName}`,
        }, (val) => {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-Access-Token': '{{ $server->daemonSecret }}',
                    'X-Access-Server': '{{ $server->uuid }}'
                },
                contentType: 'application/json; charset=utf-8',
                url: '{{ $node->scheme }}://{{ $node->fqdn }}:{{ $node->daemonListen }}/server/file/move',
                timeout: 10000,
                data: JSON.stringify({
                    from: `${currentPath}${currentName}`,
                    to: `${val}`,
                }),
            }).done(data => {
                nameBlock.parent().addClass('warning').delay(200).fadeOut();
                swal.close();
            }).fail(jqXHR => {
                console.error(jqXHR);
                var error = 'An error occured while trying to process this request.';
                if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                    error = jqXHR.responseJSON.error;
                }
                swal({
                    type: 'error',
                    title: '',
                    text: error,
                });
            });
        });

    }

    copy() {
        const nameBlock = $(this.element).find('td[data-identifier="name"]');
        const currentName = decodeURIComponent(nameBlock.attr('data-name'));
        const currentPath = decodeURIComponent(nameBlock.data('path'));

        swal({
            type: 'input',
            title: 'Copy File',
            text: 'Please enter the new path for the copied file below.',
            showCancelButton: true,
            showConfirmButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            inputValue: `${currentPath}${currentName}`,
        }, (val) => {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-Access-Token': '{{ $server->daemonSecret }}',
                    'X-Access-Server': '{{ $server->uuid }}'
                },
                contentType: 'application/json; charset=utf-8',
                url: '{{ $node->scheme }}://{{ $node->fqdn }}:{{ $node->daemonListen }}/server/file/copy',
                timeout: 10000,
                data: JSON.stringify({
                    from: `${currentPath}${currentName}`,
                    to: `${val}`,
                }),
            }).done(data => {
                swal({
                    type: 'success',
                    title: '',
                    text: 'File successfully copied.'
                });
                Files.list();
            }).fail(jqXHR => {
                console.error(jqXHR);
                var error = 'An error occured while trying to process this request.';
                if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                    error = jqXHR.responseJSON.error;
                }
                swal({
                    type: 'error',
                    title: '',
                    text: error,
                });
            });
        });

    }

    download() {
        const nameBlock = $(this.element).find('td[data-identifier="name"]');
        const fileName = decodeURIComponent(nameBlock.attr('data-name'));
        const filePath = decodeURIComponent(nameBlock.data('path'));

        window.location = `/server/{{ $server->uuidShort }}/files/download/${filePath}${fileName}`;
    }

    rename() {
        const nameBlock = $(this.element).find('td[data-identifier="name"]');
        const currentLink = nameBlock.find('a');
        const currentName = decodeURIComponent(nameBlock.attr('data-name'));
        const attachEditor = `
            <input class="form-control input-sm" type="text" value="${currentName}" />
            <span class="input-loader"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
        `;

        nameBlock.html(attachEditor);
        const inputField = nameBlock.find('input');
        const inputLoader = nameBlock.find('.input-loader');

        inputField.focus();
        inputField.on('blur keydown', e => {
            // Save Field
            if (
                (e.type === 'keydown' && e.which === 27)
                || e.type === 'blur'
                || (e.type === 'keydown' && e.which === 13 && currentName === inputField.val())
            ) {
                if (!_.isEmpty(currentLink)) {
                    nameBlock.html(currentLink);
                } else {
                    nameBlock.html(currentName);
                }
                inputField.remove();
                ContextMenu.unbind().run();
                return;
            }

            if (e.type === 'keydown' && e.which !== 13) return;

            inputLoader.show();
            const currentPath = decodeURIComponent(nameBlock.data('path'));

            $.ajax({
                type: 'POST',
                headers: {
                    'X-Access-Token': '{{ $server->daemonSecret }}',
                    'X-Access-Server': '{{ $server->uuid }}'
                },
                contentType: 'application/json; charset=utf-8',
                url: '{{ $node->scheme }}://{{ $node->fqdn }}:{{ $node->daemonListen }}/server/file/rename',
                timeout: 10000,
                data: JSON.stringify({
                    from: `${currentPath}${currentName}`,
                    to: `${currentPath}${inputField.val()}`,
                }),
            }).done(data => {
                nameBlock.attr('data-name', inputField.val());
                if (!_.isEmpty(currentLink)) {
                    let newLink = currentLink.attr('href');
                    if (nameBlock.parent().data('type') !== 'folder') {
                        newLink = newLink.substr(0, newLink.lastIndexOf('/')) + '/' + inputField.val();
                    }
                    currentLink.attr('href', newLink);
                    nameBlock.html(
                        currentLink.html(inputField.val())
                    );
                } else {
                    nameBlock.html(inputField.val());
                }
                inputField.remove();
            }).fail(jqXHR => {
                console.error(jqXHR);
                var error = 'An error occured while trying to process this request.';
                if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                    error = jqXHR.responseJSON.error;
                }
                nameBlock.addClass('has-error').delay(2000).queue(() => {
                    nameBlock.removeClass('has-error').dequeue();
                });
                inputField.popover({
                    animation: true,
                    placement: 'top',
                    content: error,
                    title: 'Save Error'
                }).popover('show');
            }).always(() => {
                inputLoader.remove();
                ContextMenu.unbind().run();
            });
        });
    }

    delete() {
        const nameBlock = $(this.element).find('td[data-identifier="name"]');
        const delPath = decodeURIComponent(nameBlock.data('path'));
        const delName = decodeURIComponent(nameBlock.data('name'));

        swal({
            type: 'warning',
            title: '',
            text: 'Are you sure you want to delete <code>' + delName + '</code>? There is <strong>no</strong> reversing this action.',
            html: true,
            showCancelButton: true,
            showConfirmButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, () => {
            $.ajax({
                type: 'DELETE',
                url: `{{ $node->scheme }}://{{ $node->fqdn }}:{{ $node->daemonListen }}/server/file/f/${delPath}${delName}`,
                headers: {
                    'X-Access-Token': '{{ $server->daemonSecret }}',
                    'X-Access-Server': '{{ $server->uuid }}'
                }
            }).done(data => {
                nameBlock.parent().addClass('warning').delay(200).fadeOut();
                swal({
                    type: 'success',
                    title: 'File Deleted'
                });
            }).fail(jqXHR => {
                console.error(jqXHR);
                swal({
                    type: 'error',
                    title: 'Whoops!',
                    html: true,
                    text: 'An error occured while attempting to delete this file. Please try again.',
                });
            });
        });
    }

    decompress() {
        const nameBlock = $(this.element).find('td[data-identifier="name"]');
        const compPath = decodeURIComponent(nameBlock.data('path'));
        const compName = decodeURIComponent(nameBlock.data('name'));

        $.ajax({
            type: 'POST',
            url: `{{ $node->scheme }}://{{ $node->fqdn }}:{{ $node->daemonListen }}/server/file/decompress`,
            headers: {
                'X-Access-Token': '{{ $server->daemonSecret }}',
                'X-Access-Server': '{{ $server->uuid }}'
            },
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify({
                files: `${compPath}${compName}`
            })
        }).done(data => {
            Files.list(compPath);
        }).fail(jqXHR => {
            console.error(jqXHR);
            var error = 'An error occured while trying to process this request.';
            if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                error = jqXHR.responseJSON.error;
            }
            swal({
                type: 'error',
                title: 'Whoops!',
                html: true,
                text: error
            });
        });
    }

    compress() {
        const nameBlock = $(this.element).find('td[data-identifier="name"]');
        const compPath = decodeURIComponent(nameBlock.data('path'));
        const compName = decodeURIComponent(nameBlock.data('name'));

        $.ajax({
            type: 'POST',
            url: `{{ $node->scheme }}://{{ $node->fqdn }}:{{ $node->daemonListen }}/server/file/compress`,
            headers: {
                'X-Access-Token': '{{ $server->daemonSecret }}',
                'X-Access-Server': '{{ $server->uuid }}'
            },
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify({
                files: `${compPath}${compName}`,
                to: compPath.toString()
            })
        }).done(data => {
            Files.list(compPath, err => {
                if (err) return;
                const fileListing = $('#file_listing').find(`[data-name="${data.saved_as}"]`).parent();
                fileListing.addClass('success pulsate').delay(3000).queue(() => {
                    fileListing.removeClass('success pulsate').dequeue();
                });
            });
        }).fail(jqXHR => {
            console.error(jqXHR);
            var error = 'An error occured while trying to process this request.';
            if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                error = jqXHR.responseJSON.error;
            }
            swal({
                type: 'error',
                title: 'Whoops!',
                html: true,
                text: error
            });
        });
    }
}
