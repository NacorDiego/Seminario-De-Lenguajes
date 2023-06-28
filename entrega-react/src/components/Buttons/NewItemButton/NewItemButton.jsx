import { faPlus } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import './NewItemButton.css'

function NewItemButton() {
  return (
    <>
      <button className="btn-nuevo">
        <FontAwesomeIcon className='btn-nuevo__icono' icon={faPlus} />
        Agregar
      </button>
    </>
  )
}

export default NewItemButton
