import 'package:flutter/material.dart';
import '../models/cultivo.dart';
import '../services/cultivo_service.dart';

class CrearCultivoScreen extends StatefulWidget {
  const CrearCultivoScreen({super.key});

  @override
  State<CrearCultivoScreen> createState() => _CrearCultivoScreenState();
}

class _CrearCultivoScreenState extends State<CrearCultivoScreen> {
  final _formKey = GlobalKey<FormState>();
  final _nombreController = TextEditingController();
  final _tipoController = TextEditingController();
  final _fechaController = TextEditingController();
  final CultivoService _cultivoService = CultivoService();
  bool _isSaving = false;
  DateTime? _selectedDate;

  Future<void> _guardarCultivo() async {
    if (_formKey.currentState!.validate()) {
      setState(() => _isSaving = true);

      try {
        final nuevoCultivo = Cultivo(
          id: 0,
          nombre: _nombreController.text.trim(),
          tipo: _tipoController.text.trim().isEmpty
              ? null
              : _tipoController.text.trim(),
          fecha: _selectedDate,
        );

        final exito = await _cultivoService.addCultivo(nuevoCultivo);

        if (mounted) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text(exito
                  ? 'Cultivo creado correctamente'
                  : 'Error al crear el cultivo'),
              backgroundColor: exito ? Colors.green : Colors.red,
            ),
          );
          if (exito) Navigator.pop(context, true);
        }
      } catch (e) {
        if (mounted) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text('Error: ${e.toString()}')),
          );
        }
      } finally {
        setState(() => _isSaving = false);
      }
    }
  }

  Future<void> _selectDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2000),
      lastDate: DateTime(2101),
    );
    if (picked != null) {
      setState(() {
        _selectedDate = picked;
        _fechaController.text = "${picked.day}/${picked.month}/${picked.year}";
      });
    }
  }

  @override
  void dispose() {
    _nombreController.dispose();
    _tipoController.dispose();
    _fechaController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Agregar Cultivo'),
        backgroundColor: Colors.green.shade700,
      ),
      body: Stack(
        children: [
          SingleChildScrollView(
            padding: const EdgeInsets.all(16),
            child: Card(
              elevation: 6,
              shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12)),
              child: Padding(
                padding: const EdgeInsets.all(20),
                child: Form(
                  key: _formKey,
                  child: Column(
                    children: [
                      TextFormField(
                        controller: _nombreController,
                        decoration: InputDecoration(
                          labelText: 'Nombre del Cultivo',
                          prefixIcon: const Icon(Icons.agriculture),
                          border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(10)),
                          filled: true,
                          fillColor: Colors.green.shade50,
                        ),
                        validator: (value) =>
                            value == null || value.trim().isEmpty
                                ? 'Por favor, ingrese un nombre válido'
                                : null,
                      ),
                      const SizedBox(height: 16),
                      TextFormField(
                        controller: _tipoController,
                        decoration: InputDecoration(
                          labelText: 'Tipo (opcional)',
                          prefixIcon: const Icon(Icons.category_outlined),
                          border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(10)),
                          filled: true,
                          fillColor: Colors.green.shade50,
                        ),
                      ),
                      const SizedBox(height: 16),
                      TextFormField(
                        controller: _fechaController,
                        readOnly: true,
                        onTap: () => _selectDate(context),
                        decoration: InputDecoration(
                          labelText: 'Fecha de Siembra',
                          prefixIcon: const Icon(Icons.date_range),
                          border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(10)),
                          filled: true,
                          fillColor: Colors.green.shade50,
                        ),
                        validator: (_) => _selectedDate == null
                            ? 'Por favor, seleccione una fecha'
                            : null,
                      ),
                      const SizedBox(height: 24),
                      ElevatedButton.icon(
                        onPressed: _isSaving ? null : _guardarCultivo,
                        icon: const Icon(Icons.save),
                        label: const Text('Guardar'),
                        style: ElevatedButton.styleFrom(
                          minimumSize: const Size.fromHeight(50),
                          backgroundColor: Colors.green.shade700,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),
          if (_isSaving)
            const LinearProgressIndicator(
              backgroundColor: Colors.white,
              minHeight: 4,
            ),
        ],
      ),
    );
  }
}