import { faPlus } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import './NewItemButton.css'

function NewItemButton() {
  return (
    <>
      <button className='btn-new'>
        <FontAwesomeIcon icon={faPlus} />
        Agregar
      </button>
    </>
  )
}

export default NewItemButton
