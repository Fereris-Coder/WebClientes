using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using WebClientes.Data;
using WebClientes.Models;

namespace WebClientes.Controllers
{
    public class ClienteController : Controller
    {
        private readonly ApplicationDbContext _ContextCliente;

        public ClienteController (ApplicationDbContext ContextCliente)
        {
            _ContextCliente = ContextCliente;
        }



        // GET: ClienteController
        public async Task<ActionResult> Index()
        {
            return View(await _ContextCliente.Clientes.ToListAsync());
        }

        // GET: ClienteController/Details/5
        public async Task<ActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var cliente = await _ContextCliente.Clientes
                .FirstOrDefaultAsync(m => m.Id == id);

            if (cliente == null)
            {
                return NotFound();
            }

            return View(cliente);
        }

        // GET: ClienteController/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: ClienteController/Create
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<ActionResult> Create(Cliente cli)
        {
            
            if(ModelState.IsValid)
            {
                _ContextCliente.Add(cli);
                await _ContextCliente.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(cli);

        }

        // GET: ClienteController/Edit/5
        public async Task<ActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var cliente = await _ContextCliente.Clientes.FindAsync(id);

            if (cliente == null)
            {
                return NotFound();
            }

            return View(cliente);
        }

        // POST: ClienteController/Edit/5
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<ActionResult> Edit(int id, Cliente cli)
        {
            if (id != cli.Id)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                _ContextCliente.Update(cli);
                await _ContextCliente.SaveChangesAsync();

                return RedirectToAction(nameof(Index));
            }

            return View(cli);
        }

        // GET: ClienteController/Delete/5
        public async Task<ActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var cliente = await _ContextCliente.Clientes
                .FirstOrDefaultAsync(m => m.Id == id);

            if (cliente == null)
            {
                return NotFound();
            }

            return View(cliente);
        }

        // POST: ClienteController/Delete/5
        [HttpPost]
        [ValidateAntiForgeryToken]

        public async Task<ActionResult> DeleteConfirmed(int id)
        {
            var cliente = await _ContextCliente.Clientes.FindAsync(id);

            if (cliente != null)
            {
                _ContextCliente.Clientes.Remove(cliente);
                await _ContextCliente.SaveChangesAsync();
            }

            return RedirectToAction(nameof(Index));
        }
    }
}
