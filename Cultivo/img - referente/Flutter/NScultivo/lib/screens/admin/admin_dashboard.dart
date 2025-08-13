import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../models/cultivo_model.dart';
import '../../providers/auth_provider.dart';
import '../../providers/cultivo_provider.dart';
import '../../config/theme.dart';
import '../login_screen.dart';
import 'cultivos/cultivo_form.dart';

class AdminDashboard extends StatefulWidget {
  const AdminDashboard({Key? key}) : super(key: key);

  @override
  State<AdminDashboard> createState() => _AdminDashboardState();
}

class _AdminDashboardState extends State<AdminDashboard> {
  @override
  void initState() {
    super.initState();
    // Cargar los cultivos cuando se inicia el dashboard
    Future.microtask(
      () => context.read<CultivoProvider>().loadCultivos(),
    );
  }

  void _showCultivoForm(BuildContext context, [Cultivo? cultivo]) {
    showDialog(
      context: context,
      builder: (context) => CultivoForm(cultivo: cultivo),
    );
  }

  @override
  Widget build(BuildContext context) {
    final authProvider = Provider.of<AuthProvider>(context);

    return Scaffold(
      appBar: AppBar(
        title: const Text('Panel de Administrador'),
        backgroundColor: Colors.green.shade700,
        elevation: 0,
        actions: [
          IconButton(
            icon: const Icon(Icons.logout),
            onPressed: () async {
              await authProvider.logout();
              if (context.mounted) {
                Navigator.of(context).pushReplacement(
                  MaterialPageRoute(builder: (_) => const LoginScreen()),
                );
              }
            },
          ),
        ],
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () => _showCultivoForm(context),
        backgroundColor: Colors.green.shade600,
        child: const Icon(Icons.add),
      ),
      body: Container(
        decoration: BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [
              Colors.green.shade50,
              Colors.blue.shade50,
            ],
          ),
        ),
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                'Bienvenido, ${authProvider.user?.name ?? "Administrador"}',
                style: Theme.of(context).textTheme.headlineSmall?.copyWith(
                  color: Colors.green.shade800,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(height: 24),
              _buildStatsCards(),
              const SizedBox(height: 24),
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    'Gestión de Cultivos',
                    style: TextStyle(
                      fontSize: 20,
                      fontWeight: FontWeight.bold,
                      color: Colors.green.shade800,
                    ),
                  ),
                  ElevatedButton.icon(
                    onPressed: () => _showCultivoForm(context),
                    icon: const Icon(Icons.add),
                    label: const Text('Nuevo Cultivo'),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.green.shade600,
                      foregroundColor: Colors.white,
                      elevation: 2,
                      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 16),
              Expanded(
                child: _buildCultivosList(),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildStatsCards() {
    return Consumer<CultivoProvider>(
      builder: (context, provider, _) {
        return Container(
          height: 100,
          child: ListView(
            scrollDirection: Axis.horizontal,
            children: [
              _buildStatCard(
                title: 'Total Cultivos',
                value: '${provider.cultivos.length}',
                icon: Icons.eco,
                color: Colors.green.shade600,
              ),
              const SizedBox(width: 16),
              _buildStatCard(
                title: 'Registrados',
                value: '${provider.cultivos.where((c) => c.id != null).length}',
                icon: Icons.check_circle,
                color: Colors.blue.shade600,
              ),
              const SizedBox(width: 16),
              _buildStatCard(
                title: 'Última Actualización',
                value: _getLastUpdateTime(provider),
                icon: Icons.update,
                color: Colors.orange.shade600,
              ),
            ],
          ),
        );
      },
    );
  }

  Widget _buildStatCard({
    required String title,
    required String value,
    required IconData icon,
    required Color color,
  }) {
    return Container(
      width: 200,
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [
          BoxShadow(
            color: Colors.grey.withOpacity(0.1),
            spreadRadius: 1,
            blurRadius: 5,
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Row(
            children: [
              Icon(icon, color: color, size: 24),
              const SizedBox(width: 8),
              Text(
                title,
                style: TextStyle(
                  color: Colors.grey.shade600,
                  fontSize: 14,
                ),
              ),
            ],
          ),
          const SizedBox(height: 8),
          Text(
            value,
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.bold,
              color: color,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildCultivosList() {
    return Consumer<CultivoProvider>(
      builder: (context, provider, _) {
        if (provider.isLoading) {
          return const Center(child: CircularProgressIndicator());
        }

        if (provider.cultivos.isEmpty) {
          return Center(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Icon(
                  Icons.eco_outlined,
                  size: 64,
                  color: Colors.grey.shade400,
                ),
                const SizedBox(height: 16),
                Text(
                  'No hay cultivos registrados',
                  style: TextStyle(
                    fontSize: 18,
                    color: Colors.grey.shade600,
                  ),
                ),
                const SizedBox(height: 24),
                ElevatedButton.icon(
                  onPressed: () => _showCultivoForm(context),
                  icon: const Icon(Icons.add),
                  label: const Text('Agregar Cultivo'),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.green.shade600,
                    foregroundColor: Colors.white,
                  ),
                ),
              ],
            ),
          );
        }

        return ListView.builder(
          itemCount: provider.cultivos.length,
          itemBuilder: (context, index) {
            final cultivo = provider.cultivos[index];
            return Card(
              elevation: 2,
              margin: const EdgeInsets.symmetric(vertical: 8),
              child: ListTile(
                leading: CircleAvatar(
                  backgroundColor: Colors.green.shade100,
                  child: Icon(
                    Icons.eco,
                    color: Colors.green.shade700,
                  ),
                ),
                title: Text(
                  cultivo.nombre,
                  style: const TextStyle(
                    fontWeight: FontWeight.bold,
                  ),
                ),
                subtitle: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Tipo: ${cultivo.tipo}'),
                    Text('Fecha: ${_formatDate(cultivo.fecha)}'),
                  ],
                ),
                trailing: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    IconButton(
                      icon: const Icon(Icons.edit),
                      color: Colors.blue.shade600,
                      onPressed: () => _showCultivoForm(context, cultivo),
                    ),
                    IconButton(
                      icon: const Icon(Icons.delete),
                      color: Colors.red.shade400,
                      onPressed: () => _showDeleteDialog(context, cultivo),
                    ),
                  ],
                ),
              ),
            );
          },
        );
      },
    );
  }

  void _showDeleteDialog(BuildContext context, Cultivo cultivo) {
    if (cultivo.id == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('No se puede eliminar un cultivo sin ID'),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Eliminar Cultivo'),
        content: Text('¿Estás seguro de que deseas eliminar el cultivo "${cultivo.nombre}"?'),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Cancelar'),
          ),
          TextButton(
            onPressed: () {
              context.read<CultivoProvider>().deleteCultivo(cultivo.id!);
              Navigator.pop(context);
              ScaffoldMessenger.of(context).showSnackBar(
                SnackBar(
                  content: const Text('Cultivo eliminado correctamente'),
                  backgroundColor: Colors.green.shade600,
                ),
              );
            },
            child: const Text(
              'Eliminar',
              style: TextStyle(color: Colors.red),
            ),
          ),
        ],
      ),
    );
  }

  String _formatDate(DateTime date) {
    return '${date.day}/${date.month}/${date.year}';
  }

  String _getLastUpdateTime(CultivoProvider provider) {
    if (provider.cultivos.isEmpty) return '-';
    final lastUpdate = provider.cultivos
        .map((c) => c.updatedAt ?? c.fecha)
        .reduce((a, b) => a.isAfter(b) ? a : b);
    return '${lastUpdate.hour}:${lastUpdate.minute.toString().padLeft(2, '0')}';
  }
} 