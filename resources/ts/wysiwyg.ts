export const Wysiwyg = () => {
    interface Button extends Element {
        action?: string;
    }

    const editor = document.querySelector('.wysiwyg');
    const toolbar = editor?.querySelector('.wysiwyg__toolbar');
    const buttons = toolbar?.querySelectorAll('.wysiwyg__btn');
    const contentArea = editor?.querySelector('.wysiwyg__contentArea');
    const contentVisual = contentArea?.querySelector('.wysiwyg__contentArea--visual');
    const contentHtml = contentArea?.querySelector('.wysiwyg__contentArea--html');
    const modal = editor?.querySelectorAll('.wysiwyg__modal');
    const actionLink = () => {
        //
    }
    const actionDefault = (action: string) => {
        let range = window?.getSelection()?.getRangeAt(0);
        range?.surroundContents(document.createElement(action));

    }
    for (let i = 0; i < buttons?.length!; i++){
        let button: Button = buttons![i];
        button.addEventListener('click', function(e){
            let action = button.action;
            switch(action){
                case 'createLink':
                    actionLink();
                default:
                    actionDefault(action!);
            }
        });
    }
}