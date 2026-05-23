using System.ComponentModel.DataAnnotations;

namespace WebClientes.Models
{
    public class Cliente
    {
        public int Id { get; set; }
        
        [Required(ErrorMessage = "El campo es obligatorio")]
        
        [MinLength(10)]
        [MaxLength(13)]
        public string Cedula { get; set; }
        [Required(ErrorMessage = "El campo es obligatorio")]

        public string Nombres { get; set; }
        [Required(ErrorMessage = "El campo es obligatorio")]

        public string Apellidos { get; set; }
        [Required(ErrorMessage = "El campo es obligatorio")]
        public string Direccion { get; set; }
        [Required(ErrorMessage = "El campo es obligatorio")]
        public string Genero { get; set; }
    }
}
