import { Descendant } from "slate";
import { CustomElement, CustomText, FormattedText } from "../types/Types";

const Deserialize = (serializedContent: Descendant[] | CustomText[]) => {
    let deserializedContent: String
    const addText = (txt: FormattedText, openBold: boolean = false, openItalic: boolean = false, openStrike: boolean = false, openUnder: boolean = false) => {
        let deserializedText: String
    }
    const addCustom = (ele: CustomElement) => {
        let deserializedCustom: String
        const type: String = ele.type
            deserializedCustom += `<${type}>`
        const children: CustomText[] = ele.children
        for (let i = 0; i < children.length; i++){
            const child = children[i]

        }
    }
    for (let i = 0; i < serializedContent.length; i++){
        const ele = serializedContent[i]
        
    }
    return(
        <div>

        </div>
    )
}

export default Deserialize;